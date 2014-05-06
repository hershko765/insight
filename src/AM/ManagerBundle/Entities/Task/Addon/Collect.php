<?php

namespace AM\ManagerBundle\Entities\Task\Addon;


use Core\Base\TaskManager;
use Core\Interfaces\Task;
use Doctrine\Bundle\DoctrineBundle\Registry;

class Collect extends TaskManager implements Task {

	/**
	 * @var Registry
	 * @DI (alias=doctrine)
	 */
	protected $em;

	public function setData() {}
	public function execute() {}
}
 