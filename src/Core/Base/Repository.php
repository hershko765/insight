<?php
namespace Core\Base;

use Doctrine\ORM\EntityRepository;
use Core\Helpers\Arr;

class Repository extends EntityRepository {

	/**
	 * Generic finding records by custom options
	 * ## Example
	 * filters -  [ 'name'   => 'somename' ]
	 * paging  -  [ 'limit'  => 5, 'offset' => 10 ]
	 * settings - [ 'select' => [ 'id', 'title' ]
	 *
	 * @param array $filters
	 * @param array $paging
	 * @param array $settings
	 */
	public function collect(array $filters = [], array $paging = [], array $settings = []) {}

	/**
	 * Get single record
	 *
	 * @param $id
	 */
	public function get($id) {}

	/**
	 * Create record
	 *
	 * @param array $data
	 */
	public function create(array $data) {}

	/**
	 * Update a record
	 *
	 * @param       $id
	 * @param array $data
	 */
	public function update($id, array $data) {}

	/**
	 * Make an update or create depends
	 * on the data given
	 *
	 * @param array $data
	 */
	public function save(array $data)
	{
		return Arr::get($data, 'id')
		? $this->update($data['id'], $data)
		: $this->create($data);
	}

	/**
	 * Delete a record
	 *
	 * @param $id
	 */
	public function delete($id) {}

	private function add_filters($filters) {}
	private function add_paging($paging) {}
	private function convert($data) {}
}