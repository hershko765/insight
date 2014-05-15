<?php

namespace App\ManagerBundle\Entities\Handler\Addon;

use App\ManagerBundle\Entities\Model\Addon;
use App\SourceBundle\Base\Repository\Repository;
use App\SourceBundle\Base\HandlerManager;
use App\SourceBundle\Interfaces\Handler;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Validator\Validator;

class Create extends HandlerManager implements Handler {

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
		$addon = new Addon();

		// Get repository and filter data to contain only allowed data
		$repo = $this->em->getRepository('AppManagerBundle:Model\Addon');
		$repo->hydrate($this->data, $addon, Repository::PERM_CREATE);

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