<?php
namespace Core\Interfaces\TaskTypes;

interface Collect {

	/**
	 * @param array $filters
	 * @param array $paging
	 * @param array $settings
	 * @return mixed
	 */
	public function setData(array $filters = [], array $paging = [], array $settings = []);

	/**
	 * execute must always return array
	 *
	 * @return array
	 */
	public function execute();

}
