<?php

namespace AM\ManagerBundle\Entities\Task\Addon;

use AM\ManagerBundle\Entities\Model\Addon;
use Core\Base\Repository\Repository;
use Core\Base\TaskManager;
use Core\Interfaces\Task;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Validator\Validator;

class Create extends TaskManager implements Task {

	/**
	 * @var Registry
	 * @DI (alias=doctrine)
	 */
	protected $em;

	/**
	 * @var Validator
	 * @DI (alias=validator)
	 */
	protected $validate;

	/**
	 * Outsource data
	 * @var array
	 */
	protected $data;

	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	public function execute()
	{
		// Get repository and filter data to contain only allowed data
		$repo = $this->em->getRepository('AMManagerBundle:Model\Addon');
		$repo->convert($this->data, Repository::PERM_CREATE);

		// Create empty model and apply data
		$addon = new Addon();
		$addon->setValues($this->data);

		// Validate model, check for errors and return them if exists
		$errors = $this->validate->validate($addon);
		if(count($errors) > 0)
		{
			return [
				'status' => FALSE,
				'errors' => $this->errorsToArr($errors)
			];
		}

		// Save model and return data response with the new ID
		return [
			'status' => TRUE,
			'data_array' => $repo->save($addon)
		];
	}
}