<?php

namespace Elgg;

interface Upgrade {

	/**
	 * Is this upgrade required
	 *
	 * @return boolean
	 */
	public function isRequired();
}
