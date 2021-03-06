<?php

namespace App\ManagerBundle\Entities\Handler\Addon;

use App\SourceBundle\Base\Repository\Repository;
use App\SourceBundle\Base\HandlerManager;
use App\SourceBundle\Interfaces\Handler;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Validator;
use App\SourceBundle\Helpers\Arr;

class Update extends HandlerManager implements Handler {

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
	 * data to update
	 * @var array
	 */
	protected $data, $id;

	public function setData(array $data, $id)
	{
		$this->data = $data;
		$this->id = $id;
		return $this;
	}

	public function execute()
	{
		// Get repository and filter data to contain only allowed data
		$repo = $this->em->getRepository('AppManagerBundle:Model\Addon');

		// Load model by id, throw exception if nothing found
		$addon = $repo->find($this->id);
		if ( ! $addon)
			throw new NotFoundHttpException('Addon not found for id: '.$this->id);

		$repo->hydrate($this->data, $addon, Repository::PERM_CREATE);

		// Validate model, if errors found return them
		$errors = $this->validate->validate($addon);
		if(count($errors) > 0)
		{
			return [
				'status' => FALSE,
				'errors' => $this->errorsToArr($errors)
			];
		}

		// Add categories if given and if given as array
		if (is_array(Arr::get($this->data, 'categories')))
		{
			$this->handlerGateway->getHandler('Addon:Category', 'Flush', 'manager')
				->setData($addon, $this->data['categories'])
				->execute();
		}

		// Save model into the database and return response
		return [
			'status' => TRUE,
			'data_array' => $repo->save($addon)
		];
	}
}