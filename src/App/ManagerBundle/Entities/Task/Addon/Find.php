<?php

namespace App\ManagerBundle\Entities\Task\Addon;

use App\SourceBundle\Base\TaskManager;
use App\SourceBundle\Interfaces\Task;
use Doctrine\Bundle\DoctrineBundle\Registry;
use App\SourceBundle\Base\Model;

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
		return $this->em->getRepository('AppManagerBundle:Model\Addon')->find($this->id);
	}
}
 