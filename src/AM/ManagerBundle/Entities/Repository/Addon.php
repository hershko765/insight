<?php
namespace AM\ManagerBundle\Entities\Repository;

use Core\Base\Repository\Repository;

class Addon extends Repository {

	protected $tableName = 'addons';

	/**
	 * Entity available filters
	 *
	 * [ <Filter Name>, <Related Column>, <Mysql Operator>
	 * @var array
	 */
	protected $filterMap = [
		[ 'addonFilter', 'addon', 'BETWEEN' ]
	];

	/**
	 * List of table fields
	 * @var array
	 */
	protected $tableMap = [
		'id'          => [ 'varchar(255)', self::PERM_CREATE ],
		'addon'       => [ 'varchar(255)', self::PERM_ALL    ],
		'description' => [ 'text',         self::PERM_ALL    ],
	];
}
 