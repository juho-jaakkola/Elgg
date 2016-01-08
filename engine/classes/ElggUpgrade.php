<?php
/**
 * Upgrade object for upgrades that need to be tracked
 * and listed in the admin area.
 */

/**
 * Represents an upgrade that runs outside of the upgrade.php script.
 * These are listed in admin/upgrades and allow for ajax upgrades.
 *
 * @package Elgg.Admin
 * @access private
 */
class ElggUpgrade extends \ElggObject {
	private $requiredProperties = array(
		'title',
		'description',
		'class',
	);

	/**
	 * Set subtype to upgrade
	 *
	 * @return null
	 */
	public function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = 'elgg_upgrade';

		// unowned
		$this->attributes['site_guid'] = 0;
		$this->attributes['container_guid'] = 0;
		$this->attributes['owner_guid'] = 0;

		$this->is_completed = 0;
	}

	/**
	 * Mark this upgrade as completed
	 *
	 * @return bool
	 */
	public function setCompleted() {
		$this->setCompletedTime();
		return $this->is_completed = true;
	}

	/**
	 * Has this upgrade completed?
	 *
	 * @return bool
	 */
	public function isCompleted() {
		return (bool) $this->is_completed;
	}

	/**
	 * Set the upgrade class name
	 *
	 * @param string $class The class that takes care of the upgrade
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setClass($class) {
		if (!$class) {
			throw new InvalidArgumentException('Invalid value for upgrade class.');
		}

		$this->class = $class;
	}

	/**
	 * Get the upgrade class name
	 *
	 * @return string The class that takes care of the upgrade
	 */
	public function getClass() {
		return $this->class;
	}

	/**
	 * Sets the timestamp for when the upgrade completed.
	 *
	 * @param int $time Timestamp when upgrade finished. Defaults to now.
	 * @return bool
	 */
	public function setCompletedTime($time = null) {
		if (!$time) {
			$time = time();
		}

		return $this->completed_time = $time;
	}

	/**
	 * Gets the time when the upgrade completed.
	 *
	 * @return string
	 */
	public function getCompletedTime() {
		return $this->completed_time;
	}

	/**
	 * Require an upgrade page.
	 *
	 * @return mixed
	 * @throws UnexpectedValueException
	 */
	public function save() {
		foreach ($this->requiredProperties as $prop) {
			if (!$this->$prop) {
				throw new UnexpectedValueException("ElggUpgrade objects must have a value for the $prop property.");
			}
		}

		return parent::save();
	}

	/**
	 * Set a value as private setting or attribute.
	 *
	 * Attributes include title and description.
	 *
	 * @param string $name  Name of the attribute or private_setting
	 * @param mixed  $value Value to be set
	 * @return void
	 */
	public function __set($name, $value) {
		if (array_key_exists($name, $this->attributes)) {
			parent::__set($name, $value);
		} else {
			$this->setPrivateSetting($name, $value);
		}
	}

	/**
	 * Get an attribute or private setting value
	 *
	 * @param string $name Name of the attribute or private setting
	 * @return mixed
	 */
	public function __get($name) {
		// See if its in our base attribute
		if (array_key_exists($name, $this->attributes)) {
			return parent::__get($name);
		}

		return $this->getPrivateSetting($name);
	}
}