<?php
namespace Core\Base\Repository;

use Core\Components\SilentLog;
use Doctrine\ORM\EntityRepository;
use Core\Helpers\Arr;
use Doctrine\ORM\QueryBuilder;
use Core\Base\Repository\Core\Filter;

class Repository extends EntityRepository {

	const PERM_NONE   = 0;
	const PERM_CREATE = 1;
	const PERM_UPDATE = 2;
	const PERM_ALL    = 3;

	/**
	 * @var string
	 */
	protected $tableName;

	/**
	 * List of table fields, permissions and covert types
	 * @var
	 */
	protected $tableMap;

	/**
	 * List of available filters, to be overwritten by the child repository
	 * @var array $filterMap
	 */
	protected $filterMap;

	/**
	 * table primary key
	 * @var string
	 */
	private $pk = 'id';

	/**
	 * Get single record
	 *
	 * @param $id
	 */
	public function get($id) {}

	/**
	 * Generic finding records by custom options
	 * ## Example
	 * filters  - [ 'name'   => 'some name'       ]
	 * paging   - [ 'limit'  => 5, 'offset' => 10 ]
	 * settings - [ 'select' => [ 'id', 'title'   ]
	 *
	 * @param array $filters
	 * @param array $paging
	 * @param array $settings
	 */
	public function collect(array $filters = [], array $paging = [], array $settings = [])
	{
		$qb = $this->createQueryBuilder('entity');

		$this->addFilters($qb, $filters);
		$this->addPaging($qb, $paging);
		$this->addSettings($qb, $settings);

		return $qb->getQuery()->getArrayResult();
	}

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

	/**
	 * Add filters to query
	 *
	 * @param QueryBuilder $qb
	 * @param array        $filters
	 */
	private function addFilters(QueryBuilder &$qb, array $filters)
	{
		$filtersIdx = Arr::Column($this->filterMap, NULL, 0);

		foreach($filters as $filterName => $value)
		{
			if ( ! $this->isAllowedFilter($filterName)) continue;
			$column   = $filtersIdx[$filterName][1];
			$operator = $filtersIdx[$filterName][2];
			$filterObj = new Filter($operator, $qb);
			$filterObj->createFilter([ 'column' => $column, 'value'  => $value, 'filterName' => $filterName ]);
		}
	}

	/**
	 * Add paging options to query
	 *
	 * @param QueryBuilder $qb
	 * @param array        $paging
	 */
	private function addPaging(QueryBuilder &$qb, array $paging)
	{
		// Add limit if given
		if (Arr::get($paging, 'limit'))
			$qb->setMaxResults($paging['limit']);
		// Add offset if given
		if (Arr::get($paging, 'offset'))
			$qb->setFirstResult($paging['offset']);
		// Adding order type ( ASC, DESC ) if exists and sort if exists
		$qb->orderBy(Arr::get($paging, 'sort') ? 'entity.'.$paging['sort'] : 'entity.'.$this->pk, Arr::get($paging, 'order') == 'DESC' ? 'DESC' : 'ASC');
	}

	private function addSettings(QueryBuilder &$qb, $settings)
	{
		if(Arr::get($settings, 'select'))
		{
			foreach ($settings['select'] as $idx => $select)
			{
				if ( ! $this->isColumnExists($select)) continue;
				if($idx === 0) $qb->select('entity.'.$select);
				else $qb->addSelect('entity.'.$select);
			}
		}
	}

	private function convert($data) {}

	/**
	 * Check if a given filter is allowed by the filter map
	 * of the repository, create a silent report if not
	 *
	 * @param $filter
	 * @return bool
	 */
	private function isAllowedFilter($filter)
	{
		$filters = Arr::Column($this->filterMap, 1, 0);
		if ( ! array_key_exists($filter, $filters))
		{
			SilentLog::getInstance()->silentLog([
				'message' => 'Not allowed filter request access',
				'metadata' => 'filterName='.$filter.'&table='.$this->tableName
			]);
			return FALSE;
		}
		return TRUE;
	}

	private function isColumnExists($col)
	{
		if ( ! Arr::get($this->tableMap, $col))
		{
			SilentLog::getInstance()->silentLog([
				'message'  => 'Column not exists on select settings',
				'metadata' => 'column='.$col.'&table='.$this->tableName
			]);
			return FALSE;
		}
		return TRUE;
	}
}

/**
 * Filter classes
 * Filter Converters
 */