<?php

namespace App\ManagerBundle\Entities\Handler\Category;

use App\SourceBundle\Base\Repository\Repository;
use App\SourceBundle\Base\HandlerManager;
use App\SourceBundle\Interfaces\Handler;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Validator;

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
		$repo = $this->em->getRepository('AppManagerBundle:Model\Category');
		$repo->convert($this->data, Repository::PERM_UPDATE);

		// Load model by id, throw exception if nothing found
		$category = $repo->find($this->id);
		if ( ! $category)
			throw new NotFoundHttpException('Category not found for id: '.$this->id);

		// Inject values
		$category->setValues($this->data);

		// Validate model, if errors found return them
		$errors = $this->validate->validate($category);
		if(count($errors) > 0)
		{
			return [
				'status' => FALSE,
				'errors' => $this->errorsToArr($errors)
			];
		}

		// Save model into the database and return response
		return [
			'status' => TRUE,
			'data_array' => $repo->save($category)
		];
	}
}