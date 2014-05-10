<?php

namespace AM\ManagerBundle\Entities\Task\Addon;

use Core\Base\TaskManager;
use Core\Interfaces\Task;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Core\Base\Model;

class Find extends TaskManager implements Task {

	/**
	 * @var Registry
	 * @DI (alias=doctrine)
	 */
	protected $em;

	/**
	 * Outsource data
	 * @var array
	 */
	protected $options = [];
	protected $id;

	public function setData($id, array $options = [])
	{
		$this->options = $options;
		$this->id = $id;

		return $this;
	}

	public function execute()
	{
		return $this->em->getRepository('AMManagerBundle:Model\Addon')->find($this->id);
	}
}
 