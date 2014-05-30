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
		[ 'search', 'title', 'LIKE' ],
		[ 'category', 'category', 'custom' ],
	];

	/**
	 * List of table fields
	 * @var array
	 */
	protected $tableMap = [
		'id'            => [ 'varchar',  self::PERM_NONE ],
		'title'         => [ 'varchar',  self::PERM_ALL  ],
		'name'          => [ 'varchar',  self::PERM_ALL  ],
		'description'   => [ 'text',     self::PERM_ALL  ],
		'short_desc'    => [ 'varchar',  self::PERM_ALL  ],
		'version'       => [ 'text',     self::PERM_ALL  ],
		'download_link' => [ 'text',     self::PERM_ALL  ],
		'screenshots'   => [ 'text',     self::PERM_ALL  ],
		'last_alpha'    => [ 'datetime', self::PERM_ALL  ],
		'last_release'  => [ 'datetime', self::PERM_ALL  ],
		'updated'       => [ 'datetime', self::PERM_NONE ],
		'categories'    => [ 'datetime', self::PERM_ALL ],
	];

	/**
	 * Model abilities
	 *
	 * @var array
	 */
	protected $abilities = [
		self::UPDATABLE
	];

	public function filterCategory(QueryBuilder $qb, $value)
	{
		$qb->innerJoin('entity.categories', 'c');
		$qb->where('c.id = :catID');
		$qb->setParameter(':catID', $value);
	}
}