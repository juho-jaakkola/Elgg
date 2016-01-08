<?php

namespace Elgg\Blog\Upgrades;

use \Elgg\Upgrade;

class BlogUpgrade20160115 implements \Elgg\Upgrade {

	/**
	 * Check whether the upgrade should be run
	 *
	 * @return boolean
	 */
	public function isRequired() {
		return elgg_get_entities([
			'type' => 'object',
			'subtype' => 'blog',
			'count' => true,
		]);
	}
}
