<?php
namespace App\ManagerBundle\Entities\Repository\Addon;

use App\SourceBundle\Base\Repository\Repository;
use Doctrine\ORM\QueryBuilder;

class Resource extends Repository {

	protected $tableName = 'resources';

	/**
	 * Base Resource url for handler usages
	 */
	const BASE_URL = 'http://www.wowace.com';

	/**
	 * Entity available filters
	 *
	 * [ <Filter Name>, <Related Column>, <Mysql Operator>
	 * @var array
	 */
	protected $filterMap = [];

	/**
	 * List of table fields
	 * @var array
	 */
	protected $tableMap = [
		'id'      => [ 'varchar',  self::PERM_NONE ],
		'name'    => [ 'varchar',  self::PERM_NONE ],
		'updated' => [ 'datetime', self::PERM_NONE ],
	];

	/**
	 * Model abilities
	 *
	 * @var array
	 */
	protected $abilities = [
		self::UPDATABLE
	];
}