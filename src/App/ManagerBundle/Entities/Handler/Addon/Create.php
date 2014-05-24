<?php

namespace App\ManagerBundle\Entities\Handler\Addon;

use App\ManagerBundle\Entities\Model\Addon;
use App\SourceBundle\Base\Repository\Repository;
use App\SourceBundle\Base\HandlerManager;
use App\SourceBundle\Exception\ValidationException;
use App\SourceBundle\Interfaces\Handler;
use Composer\Json\JsonValidationException;
use Doctrine\Bundle\DoctrineBundle\Registry;
use JMS\Serializer\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator;
use App\SourceBundle\Helpers\Arr;
use App\SourceBundle\Base\HandlerGateway;

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
	 * @var HandlerGateway
	 * @DI (alias=handler_gateway)
	 */
	protected $handlerGateway;

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
			throw new ValidationException($this->errorsToArr($errors));
		}

		// Add categories if given and if given as array
		if (Arr::get($this->data, 'categories') && is_array($this->data['categories']))
		{
			$this->handlerGateway->getHandler('Addon:Category', 'Flush', 'manager')
				->setData($addon, $this->data['categories'])
				->execute();
		}

		// Save model and return data response with the new ID
		return [
			'status' => TRUE,
			'data_array' => $repo->save($addon)
		];
	}
}