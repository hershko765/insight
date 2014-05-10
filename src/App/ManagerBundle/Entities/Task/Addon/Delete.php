<?php

namespace App\ManagerBundle\Entities\Task\Addon;

use App\SourceBundle\Base\TaskManager;
use App\SourceBundle\Interfaces\Task;
use Doctrine\Bundle\DoctrineBundle\Registry;

class Delete extends TaskManager implements Task {

	/**
	 * @var Registry
	 * @DI (alias=doctrine)
	 */
	protected $em;

	/**
	 * Outsource data
	 * @var array
	 */
	protected $id;

	public function setData($id)
	{
		$this->id = $id;

		return $this;
	}

	public function execute()
	{
		$repository = $this->em->getRepository('AppManagerBundle:Model\Addon');
		$repository->delete($this->id);
	}
}
 