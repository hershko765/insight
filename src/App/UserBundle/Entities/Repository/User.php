<?php
namespace App\UserBundle\Entities\Repository;

use App\SourceBundle\Base\Repository\Repository;
use App\SourceBundle\Helpers\Arr;
use Doctrine\ORM\QueryBuilder;

class User extends Repository {

	protected $tableName = 'users';

	/**
	 * Entity available filters
	 *
	 * [ <Filter Name>, <Related Column>, <Mysql Operator>
	 * @var array
	 */
	protected $filterMap = [
		[ 'search', 'full_name', 'LIKE' ],
		[ 'login', 'custom', 'custom' ],
	];

	/**
	 * List of table fields
	 * @var array
	 */
	protected $tableMap = [
		'id'        => [ 'varchar',  self::PERM_NONE ],
		'full_name' => [ 'varchar',  self::PERM_ALL  ],
		'username'  => [ 'text',     self::PERM_ALL  ],
		'password'  => [ 'text',     self::PERM_ALL  ],
		'email'     => [ 'text',     self::PERM_ALL  ],
		'phone'     => [ 'text',     self::PERM_ALL  ],
		'birthday'  => [ 'text',     self::PERM_ALL  ],
		'subscribe' => [ 'bool',     self::PERM_ALL  ],
		'updated'   => [ 'datetime', self::PERM_NONE ],
		'created'   => [ 'datetime', self::PERM_NONE ],
	];

	/**
	 * Model abilities
	 *
	 * @var array
	 */
	protected $abilities = [
		self::UPDATABLE,
		self::CREATABLE,
	];

	public function filterLogin(QueryBuilder $qb, $value)
	{
		$qb->andWhere('entity.username = :username');

		$qb->setParameter('username', Arr::get($value, 'username'));
	}
}