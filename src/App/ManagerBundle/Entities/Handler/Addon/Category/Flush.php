<?php
namespace App\ManagerBundle\Entities\Handler\Addon\Category;

use Doctrine\Bundle\DoctrineBundle\Registry;
use App\SourceBundle\Interfaces\Handler;
use App\SourceBundle\Base\HandlerManager;
use App\ManagerBundle\Entities\Model\Addon;

class Flush extends HandlerManager implements Handler {

	/**
	 * @var Registry
	 * @DI (alias=doctrine)
	 */
	protected $em;

	/**
	 * Addon model
	 * @var Addon
	 */
	protected $addon;

	/**
	 * List of categories
	 *
	 * @var array
	 */
	protected $categories;

	public function setData(&$addon, $categories = FALSE)
	{
		$this->addon = &$addon;
		$this->categories = array_unique($categories);
		return $this;
	}

	public function execute()
	{
		$repoCategory = $this->em->getRepository('AppManagerBundle:Model\Category');
		// Check if the addon already have categories
		if ( ! $this->addon->isNew())
		{
			// Get current categories, merge with given, delete the diff
			$currentCategories = $this->addon->getCategories();
			$catIds = [];
			foreach($currentCategories->toArray() as $categoryModel)
			{
				$catIds[] = $categoryModel->getId();
			}
			$toRemove = array_diff($catIds, $this->categories);

			$this->categories = array_diff($this->categories, $catIds);
			foreach($toRemove as $category)
			{
				$catModel = $repoCategory->find($category);
				$this->addon->removeCategory($catModel);
			}
		}

		// Add categories
		foreach($this->categories as $category)
		{
			$catModel = $repoCategory->find($category);
			$this->addon->addCategory($catModel);
		}
	}
}