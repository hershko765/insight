<?php
namespace App\ManagerBundle\Entities\Repository;

use App\SourceBundle\Base\Repository\Repository;
use Doctrine\ORM\QueryBuilder;

class Category extends Repository {

	protected $tableName = 'categories';

	/**
	 * Entity available filters
	 *
	 * [ <Filter Name>, <Related Column>, <Mysql Operator>
	 * @var array
	 */
	protected $filterMap = [
		[ 'search', 'name',      'LIKE' ],
		[ 'parent', 'parent_id',    '=' ],
	];

	/**
	 * List of table fields
	 * @var array
	 */
	protected $tableMap = [
		'id'        => [ 'varchar',  self::PERM_NONE ],
		'title'     => [ 'varchar',  self::PERM_ALL  ],
		'name'      => [ 'varchar',  self::PERM_ALL  ],
		'parent_id' => [ 'int',      self::PERM_ALL  ]
	];

	/**
	 * Model abilities
	 *
	 * @var array
	 */
	protected $abilities = [ ];
}