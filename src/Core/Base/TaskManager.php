<?php

namespace Core\Base;

use Core\Helpers\Arr;

class TaskManager {

	/**
	 * Inject dependencies into class properties
	 */
	public function __construct()
	{
		$args = func_get_args();
		$DIarray = Arr::get($args, count(func_get_args()) - 1);
		foreach ($DIarray as $key => $DIClass)
		{
			$this->{$DIClass} = Arr::get($args, $key);
		}
	}
}