<?php
namespace App\ManagerBundle\Entities\Repository;

use App\SourceBundle\Base\Repository\Repository;
use Doctrine\ORM\QueryBuilder;

class Addon extends Repository {

	protected $tableName = 'addons';

	/**
	 * Entity available filters
	 *
	 * [ <Filter Name>, <Related Column>, <Mysql Operator>
	 * @var array
	 */
	protected $filterMap = [
		[ 'addonFilter', 'addon', 'LIKE' ],
	];

	/**
	 * List of table fields
	 * @var array
	 */
	protected $tableMap = [
		'id'          => [ 'varchar', self::PERM_NONE ],
		'addon'       => [ 'varchar', self::PERM_ALL  ],
		'description' => [ 'text',    self::PERM_ALL  ],
	];
}