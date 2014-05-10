<?php

namespace App\ManagerBundle\Entities\Task\Addon;

use App\SourceBundle\Base\TaskManager;
use App\SourceBundle\Interfaces\Task;
use Doctrine\Bundle\DoctrineBundle\Registry;

class Collect extends TaskManager implements Task {

	/**
	 * @var Registry
	 * @DI (alias=doctrine)
	 */
	protected $em;

	/**
	 * Outsource data
	 * @var array
	 */
	protected $filters  = [];
	protected $paging   = [];
	protected $settings = [];

	public function setData(array $filters = [], array $paging = [], array $settings = [])
	{
		$this->filters  = $filters;
		$this->paging   = $paging;
		$this->settings = $settings;

		return $this;
	}

	public function execute()
	{
		return $this->em->getRepository('AppManagerBundle:Model\Addon')->collect($this->filters, $this->paging, $this->settings);
	}
}
 