<?php

namespace App\ManagerBundle\Entities\Handler\Addon;

use App\SourceBundle\Base\HandlerManager;
use App\SourceBundle\Interfaces\Handler;
use Doctrine\Bundle\DoctrineBundle\Registry;

class Delete extends HandlerManager implements Handler {

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
 