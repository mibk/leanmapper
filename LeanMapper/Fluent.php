<?php

/**
 * This file is part of the Lean Mapper library (http://www.leanmapper.com)
 *
 * Copyright (c) 2013 Vojtěch Kohout (aka Tharos)
 *
 * For the full copyright and license information, please view the file
 * license-mit.txt that was distributed with this source code.
 */

namespace LeanMapper;

use DibiFluent;

/**
 * DibiFluent with filter support
 *
 * @author Vojtěch Kohout
 */
class Fluent extends DibiFluent
{

	/**
	 * @param string $name
	 * @param mixed|null $args
	 * @return $this
	 */
	public function applyFilter($name, $args = null)
	{
		$args = func_get_args();
		$args[0] = $this;
		call_user_func_array($this->getConnection()->getFilterCallback($name), $args);
		return $this;
	}

	/**
	 * @param string|null $clause
	 * @param array|null $args
	 * @return string
	 */
	public function _export($clause = null, $args = null)
	{
		return parent::_export($clause, $args);
	}

}
