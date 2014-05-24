<?php

namespace App\ManagerBundle\Entities\Handler\Category;

use App\SourceBundle\Base\HandlerManager;
use App\SourceBundle\Interfaces\Handler;
use Doctrine\Bundle\DoctrineBundle\Registry;
use App\SourceBundle\Base\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Get extends HandlerManager implements Handler {

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
		$category = $this->em->getRepository('AppManagerBundle:Model\Category')->find($this->id);

		if ( ! $category)
			throw new NotFoundHttpException('Category Not Found!');

		return $category;
	}
}
 