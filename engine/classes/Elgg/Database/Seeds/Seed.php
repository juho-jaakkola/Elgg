<?php

namespace Elgg\Database\Seeds;

/**
 * Abstract seed
 *
 * Plugins should extend this class to create their own seeders,
 * add use 'seeds','database' plugin hook to add their seed to the sequence.
 */
abstract class Seed implements Seedable {

	/**
	 * @var int Max number of items to be created by the seed
	 */
	protected $limit = 3;

	use Seeding;

	/**
	 * Seed constructor.
	 *
	 * @param null $limit Number of item to seed
	 */
	public function __construct($limit = null) {
		if (isset($limit)) {
			$this->limit = $limit;
		}
	}

	/**
	 * Populate database
	 * @return mixed
	 */
	abstract function seed();

	/**
	 * Removed seeded rows from database
	 * @return mixed
	 */
	abstract function unseed();

	/**
	 * Get site domain
	 * @return string
	 */
	public function getDomain() {
		return elgg_get_site_entity()->getDomain();
	}

	/**
	 * Create a new faker user
	 *
	 * @param array $attributes Attributes
	 * @param array $metadata   Metadata
	 *
	 * @return bool|\ElggUser|false
	 * @throws \Exception
	 */
	public function createUser(array $attributes = [], array $metadata = []) {

		$metadata['__faker'] = true;

		if (empty($attributes['password'])) {
			$attributes['password'] = generate_random_cleartext_password();
		}

		if (empty($attributes['username'])) {
			$attributes['name'] = $this->faker->name;
		}

		if (empty($attributes['username'])) {
			$attributes['username'] = $this->getRandomUsername($attributes['name']);
		}

		if (empty($attributes['email'])) {
			$attributes['email'] = "{$attributes['username']}@{$this->getDomain()}";
			if (!filter_var($attributes['email'], FILTER_VALIDATE_EMAIL)) {
				// Travis tests use localhost as the domain name, which generates invalid email addresses
				$attributes['email'] = "{$attributes['username']}@localhost.com";
			}
		}

		$user = false;

		try {
			$guid = register_user($attributes['username'], $attributes['password'], $attributes['name'], $attributes['email']);
			$user = get_user($guid);

			$user->setValidationStatus($this->faker->boolean(), 'seeder');

			$user->setNotificationSetting('email', false);
			$user->setNotificationSetting('site', true);

			$this->populateMetadata($user, [], $metadata);
			$this->populateUserFields($user, elgg_get_config('profile_fields'));

			$user->save();

			$this->createIcon($user);
			$this->createComments($user);
			$this->createLikes($user);

			$this->log("Created new user $user->name [guid: $user->guid]");

			return $user;
		} catch (\Exception $e) {
			if ($user && $user->guid) {
				$user->delete();
			}

			$this->log($e->getMessage());

			return false;
		}

	}

	/**
	 * Create a new faker group
	 *
	 * @param array $attributes Attributes
	 * @param array $metadata   Metadata
	 *
	 * @return bool|\ElggGroup
	 * @throws \Exception
	 */
	public function createGroup(array $attributes = [], array $metadata = []) {

		$metadata['__faker'] = true;

		if (empty($attributes['access_id'])) {
			$attributes['access_id'] = ACCESS_PUBLIC;
		}

		if (empty($metadata['content_access_mode'])) {
			$metadata['content_access_mode'] = \ElggGroup::CONTENT_ACCESS_MODE_UNRESTRICTED;
		}

		if (empty($metadata['membership'])) {
			$metadata['membership'] = ACCESS_PUBLIC;
		}

		if (empty($attributes['name'])) {
			$attributes['name'] = $this->faker->sentence();
		}

		if (empty($attributes['description'])) {
			$attributes['description'] = $this->faker->text($this->faker->numberBetween(500, 1000));
		}

		if (empty($attributes['owner_guid'])) {
			$user = $this->getRandomUser();
			if (!$user) {
				$user = $this->createUser();
			}

			$attributes['owner_guid'] = $user->guid;
		}

		if (empty($attributes['container_guid'])) {
			$attributes['container_guid'] = $attributes['owner_guid'];
		}

		$owner = get_entity($attributes['owner_guid']);
		if (!$owner) {
			return false;
		}

		$container = get_entity($attributes['container_guid']);
		if (!$container) {
			return false;
		}

		$tool_options = elgg_get_config('group_tool_options');
		if ($tool_options) {
			foreach ($tool_options as $group_option) {
				$option_toggle_name = $group_option->name . "_enable";
				$option_default = $group_option->default_on ? 'yes' : 'no';
				$metadata[$option_toggle_name] = $option_default;
			}
		}

		if ($this->faker->boolean(20)) {
			$metadata['featured_group'] = 'yes';
		}

		try {

			$group = new \ElggGroup();
			foreach ($attributes as $name => $value) {
				$group->$name = $value;
			}

			$this->populateMetadata($group, elgg_get_config('group'), $metadata);

			$group->save();

			if ($group->access_id == ACCESS_PRIVATE) {
				$group->access_id = $group->group_acl;
				$group->save();
			}

			$group->join(get_user($attributes['owner_guid']));

			$this->createIcon($group);

			$this->createComments($group);
			$this->createLikes($group);

			elgg_create_river_item([
				'view' => 'river/group/create',
				'action_type' => 'create',
				'subject_guid' => $owner->guid,
				'object_guid' => $group->guid,
				'target_guid' => $container->guid,
			]);

			$this->log("Created new group $group->name [guid: $group->guid]");

			return $group;
		} catch (\Exception $e) {
			if ($group && $group->guid) {
				$group->delete();
			}

			$this->log($e->getMessage());

			return false;
		}

	}

	/**
	 * Create a new faker object
	 *
	 * @param array $attributes Attributes
	 * @param array $metadata   Metadata
	 *
	 * @return bool|\ElggObject
	 */
	public function createObject(array $attributes = [], array $metadata = []) {

		$metadata['__faker'] = true;

		if (empty($attributes['title'])) {
			$attributes['title'] = $this->faker->sentence();
		}

		if (empty($attributes['description'])) {
			$attributes['description'] = $this->faker->text($this->faker->numberBetween(500, 1000));
		}

		if (empty($attributes['container_guid'])) {
			if ($this->faker->boolean()) {
				$container = $this->getRandomGroup();
			} else {
				$container = $this->getRandomUser();
			}

			$attributes['container_guid'] = $container->guid;
		}

		if (empty($attributes['subtype'])) {
			$attributes['subtype'] = strtolower($this->faker->word);
		}

		if (empty($metadata['tags'])) {
			$metadata['tags'] = $this->faker->words(10);
		}

		if (empty($attributes['owner_guid'])) {
			if ($container instanceof \ElggGroup) {
				$members = elgg_get_entities([
					'types' => 'user',
					'relationship' => 'member',
					'relationship_guid' => $container->guid,
					'inverse_relationship' => true,
					'limit' => 0,
					'metadata_names' => '__faker',
					'order_by' => 'RAND()',
				]);
				$owner = array_shift($members);
			} else {
				$owner = $container;
			}

			$attributes['owner_guid'] = $owner->guid;
		}

		$owner = get_entity($attributes['owner_guid']);
		if (!$owner) {
			return false;
		}

		$container = get_entity($attributes['container_guid']);
		if (!$container) {
			return false;
		}

		if (empty($attributes['access_id'])) {
			$attributes['access_id'] = $this->getRandomAccessId($owner, $container);
		}

		$object = false;

		try {
			$class = elgg_get_entity_class('object', $attributes['subtype']);
			if ($class && class_exists($class)) {
				$object = new $class();
				/* @var \ElggObject $object */
			} else {
				$object = new \ElggObject();
			}
			foreach ($attributes as $name => $value) {
				$object->$name = $value;
			}

			$this->populateMetadata($object, [], $metadata);

			$object->save();

			$this->createComments($object);
			$this->createLikes($object);

			$type_str = elgg_echo("item:object:{$object->getSubtype()}");

			$this->log("Created new item in $type_str $object->title [guid: $object->guid]");

			return $object;
		} catch (\Exception $e) {
			if ($object && $object->guid) {
				$object->delete();
			}

			$this->log($e->getMessage());

			return false;
		}

	}

	/**
	 * Returns random fake user
	 *
	 * @param int[] $exclude GUIDs to exclude
	 *
	 * @return \ElggUser|false
	 */
	public function getRandomUser(array $exclude = []) {

		$exclude[] = 0;
		$exclude_in = implode(',', array_map(function ($e) {
			return (int) $e;
		}, $exclude));

		$users = elgg_get_entities([
			'types' => 'user',
			'metadata_names' => ['__faker'],
			'limit' => 1,
			'wheres' => [
				"e.guid NOT IN ($exclude_in)",
			],
			'order_by' => 'RAND()',
		]);

		return $users ? $users[0] : false;
	}

	/**
	 * Returns random fake group
	 *
	 * @param int[] $exclude GUIDs to exclude
	 *
	 * @return \ElggGroup|false
	 */
	public function getRandomGroup(array $exclude = []) {

		$exclude[] = 0;
		$exclude_in = implode(',', array_map(function ($e) {
			return (int) $e;
		}, $exclude));

		$groups = elgg_get_entities([
			'types' => 'group',
			'metadata_names' => ['__faker'],
			'limit' => 1,
			'wheres' => [
				"e.guid NOT IN ($exclude_in)",
			],
			'order_by' => 'RAND()',
		]);

		return $groups ? $groups[0] : false;
	}

	/**
	 * Get random access id
	 *
	 * @param \ElggUser   $user      User
	 * @param \ElggEntity $container Container
	 *
	 * @return int
	 */
	public function getRandomAccessId(\ElggUser $user = null, \ElggEntity $container = null) {

		$params = [
			'container_guid' => $container->guid,
		];

		$access_array = get_write_access_array($user->guid, null, null, $params);

		$access_key = array_rand($access_array, 1);

		return $access_array[$access_key];
	}

	/**
	 * Generates a unique available and valid username
	 *
	 * @param string $base_name Display name, email or other prefix to use as basis
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function getRandomUsername($base_name = 'user') {

		$available = false;

		$base_name = iconv('UTF-8', 'ASCII//TRANSLIT', $base_name);
		$blacklist = '/[\x{0080}-\x{009f}\x{00a0}\x{2000}-\x{200f}\x{2028}-\x{202f}\x{3000}\x{e000}-\x{f8ff}]/u';
		$blacklist2 = [
			' ',
			'\'',
			'/',
			'\\',
			'"',
			'*',
			'&',
			'?',
			'#',
			'%',
			'^',
			'(',
			')',
			'{',
			'}',
			'[',
			']',
			'~',
			'?',
			'<',
			'>',
			';',
			'|',
			'¬',
			'`',
			'@',
			'-',
			'+',
			'='
		];

		$base_name = preg_replace($blacklist, '', $base_name);
		$base_name = str_replace($blacklist2, '.', $base_name);

		$ia = elgg_set_ignore_access(true);

		$ha = access_get_show_hidden_status();
		access_show_hidden_entities(true);

		$minlength = elgg_get_config('minusername') ? : 4;
		if ($base_name) {
			$fill = $minlength - strlen($base_name);
		} else {
			$fill = 8;
		}

		$separator = '.';

		if ($fill > 0) {
			$suffix = (new \ElggCrypto())->getRandomString($fill);
			$base_name = "$base_name$separator$suffix";
		}

		$iterator = 0;
		while (!$available) {
			if ($iterator > 0) {
				$base_name = "$base_name$separator$iterator";
			}
			$user = get_user_by_username($base_name);
			$available = !$user;
			try {
				if ($available) {
					validate_username($base_name);
				}
			} catch (\Exception $e) {
				if ($iterator >= 10) {
					// too many failed attempts
					$base_name = (new \ElggCrypto())->getRandomString(8);
				}
			}

			$iterator++;
		}

		access_show_hidden_entities($ha);
		elgg_set_ignore_access($ia);

		return strtolower($base_name);
	}

	/**
	 * Set random metadata
	 *
	 * @param \ElggEntity $entity       Entity
	 * @param array       $group_fields An array of group profile fields in $name => $input_type format
	 * @param array       $metadata     Other metadata $name => $value pairs to set
	 *
	 * @return void
	 */
	public function populateMetadata(\ElggEntity $entity, array $group_fields = [], array $metadata = []) {

		foreach ($group_fields as $name => $type) {
			if (isset($metadata[$name])) {
				continue;
			}

			switch ($name) {
				case 'phone' :
				case 'mobile' :
					$metadata[$name] = $this->faker->phoneNumber;
					break;

				default :
					switch ($type) {
						case 'plaintext' :
						case 'longtext' :
							$metadata[$name] = $this->faker->text($this->faker->numberBetween(500, 1000));
							break;

						case 'text' :
							$metadata[$name] = $this->faker->sentence;
							break;

						case 'tags' :
							$metadata[$name] = $this->faker->words(10);
							break;

						case 'url' :
							$metadata[$name] = $this->faker->url;
							break;

						case 'email' :
							$metadata[$name] = $this->faker->email;
							break;

						case 'number' :
							$metadata[$name] = $this->faker->randomNumber();
							break;

						case 'date' :
							$metadata[$name] = $this->faker->unixTime;
							break;

						case 'password' :
							$metadata[$name] = generate_random_cleartext_password();
							break;

						case 'location' :
							$metadata[$name] = $this->faker->address;
							$metadata['geo:lat'] = $this->faker->latitude;
							$metadata['geo:long'] = $this->faker->longitude;
							break;

						default :
							$metadata[$name] = '';
							break;
					}

					break;
			}
		}

		foreach ($metadata as $key => $value) {
			$entity->$key = $value;
		}
	}

	/**
	 * Set random user fields
	 *
	 * @param \ElggUser $user   User entity
	 * @param array     $fields An array of profile fields in $name => $input_type format
	 *
	 * @return void
	 */
	public function populateUserFields(\ElggUser $user, array $fields = []) {
		$annotations = [];

		foreach ($fields as $name => $type) {
			switch ($name) {
				case 'phone' :
				case 'mobile' :
					$annotations[$name] = $this->faker->phoneNumber;
					break;

				default :
					switch ($type) {
						case 'plaintext' :
						case 'longtext' :
							$annotations[$name] = $this->faker->text($this->faker->numberBetween(500, 1000));
							break;

						case 'text' :
							$annotations[$name] = $this->faker->sentence;
							break;

						case 'url' :
							$annotations[$name] = $this->faker->url;
							break;

						case 'email' :
							$annotations[$name] = $this->faker->email;
							break;

						case 'number' :
							$annotations[$name] = $this->faker->randomNumber();
							break;

						case 'date' :
							$annotations[$name] = $this->faker->unixTime;
							break;

						case 'location' :
							$annotations[$name] = $this->faker->address;
							$annotations['geo:lat'] = $this->faker->latitude;
							$annotations['geo:long'] = $this->faker->longitude;
							break;

						default :
							$annotations[$name] = '';
							break;
					}
					break;
			}
		}

		foreach ($annotations as $key => $value) {
			$user->annotate($key, $value, ACCESS_PUBLIC);
		}
	}

	/**
	 * Create an icon for an entity
	 *
	 * @param \ElggEntity $entity Entity
	 *
	 * @return bool
	 */
	public function createIcon(\ElggEntity $entity) {

		$icon_location = $this->faker->image();
		if (empty($icon_location)) {
			return false;
		}

		$result = $entity->saveIconFromLocalFile($icon_location);

		if ($result && $entity instanceof \ElggUser) {
			elgg_create_river_item([
				'view' => 'river/user/default/profileiconupdate',
				'action_type' => 'update',
				'subject_guid' => $entity->guid,
				'object_guid' => $entity->guid,
			]);
		}

		return $result;
	}

	/**
	 * Create comments/replies
	 *
	 * @param \ElggEntity $entity Entity to comment on
	 * @param int         $limit  Number of comments to create
	 *
	 * @return int Number of generated comments
	 */
	public function createComments(\ElggEntity $entity, $limit = null) {

		$success = 0;

		if (!$limit) {
			$limit = $this->faker->numberBetween(1, 20);
		}

		while ($success < $limit) {
			$comment = new \ElggComment();
			$comment->owner_guid = $this->getRandomUser()->guid ? : $entity->owner_guid;
			$comment->container_guid = $entity->guid;
			$comment->description = $this->faker->paragraph;

			if ($comment->save()) {
				$success++;
			}
		}

		return $success;

	}

	/**
	 * Create likes
	 *
	 * @param \ElggEntity $entity Entity to like
	 * @param int         $limit  Number of likes to create
	 *
	 * @return int
	 */
	public function createLikes(\ElggEntity $entity, $limit = null) {

		$success = 0;

		if (!$limit) {
			$limit = $this->faker->numberBetween(1, 20);
		}

		while ($success < $limit) {
			if ($entity->annotate('likes', true, $entity->access_id, $this->getRandomUser()->guid)) {
				$success++;
			}
		}

		return $success;
	}

	/**
	 * Log a message
	 *
	 * @param string $msg   Message to log
	 * @param string $level Log level
	 *
	 * @return void
	 */
	public function log($msg, $level = 'NOTICE') {

		if (php_sapi_name() === 'cli') {
			$handle = $level === 'ERROR' ? STDERR : STDOUT;
			fwrite($handle, $msg . PHP_EOL);
		} else {
			elgg_log($msg, $level);
		}
	}
}
