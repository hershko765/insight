<?php

namespace App\ManagerBundle\Controller\API;

use App\SourceBundle\Base;


use App\SourceBundle\Helpers\Arr;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations;

// Annotations dependency
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class AddonController extends Base\Controller {

	/**
	 * Get single Addon,
	 *
	 * @ApiDoc(
	 *   resource = true,
	 *   description = "Gets a Page for a given id",
	 *   output = "Acme\BlogBundle\Entity\Page",
	 *   statusCodes = {
	 *     200 = "Returned when successful",
	 *     404 = "Returned when the page is not found"
	 *   }
	 * )
	 *
	 * @Annotations\View(templateVar="addon")
	 *
	 * @param int     $id      the page id
	 *
	 * @return array
	 *
	 * @throws NotFoundHttpException when page not exist
	 */
	public function getAddonAction($id)
	{
		$handler = $this->getHandler('addon', 'get');

		return $handler->setData($id)->execute();
	}

	/**
	 * Get single Addon,
	 *
	 * @ApiDoc(
	 *   resource = true,
	 *   description = "Get an addon by given ID",
	 *   filters={
	 *      {"name"="addon", "dataType"="string", "description"="search addon by name"},
	 *      {"name"="limit", "dataType"="integer"},
	 *      {"name"="offset", "dataType"="integer"},
	 *      {"name"="order", "dataType"="string", "description"="order by column"}
	 *   },
	 *   output = "App\ManagerBundle\Entities\Model\Addon",
	 *   statusCodes = {
	 *     200 = "Returned when successful",
	 *     404 = "Returned when the addon is not found"
	 *   }
	 * )
	 *
	 * @Annotations\View(templateVar="addon")
	 *
	 * @param Request $request the request object
	 * @param int     $id      the page id
	 *
	 * @return array
	 *
	 * @throws NotFoundHttpException when page not exist
	 */
	public function getAddonsAction(Request $request)
	{
		$query    = $request->query->all();
		$paging   = Arr::extract($query, [ 'limit', 'offset', 'page', 'order' ]);
		$filters  = Arr::extract($query, [ 'addon' ]);
		$settings = Arr::extract($query, [ 'select' ]);

		$handler  = $this->getHandler('addon', 'collect');
		return $handler->setData($filters, $paging, $settings)->execute();
	}

	/**
	 * Create a addon from the submitted data.
	 *
	 * @ApiDoc(
	 *   resource = true,
	 *   description = "Creates a new page from the submitted data.",
	 *   input = "Acme\BlogBundle\Form\PageType",
	 *   statusCodes = {
	 *     200 = "Returned when successful",
	 *     400 = "Returned when the form has errors"
	 *   }
	 * )
	 *
	 * @Annotations\View(templateVar="addon")
	 *
	 * @param Request $request the request object
	 *
	 * @return array
	 */
	public function postAddonAction(Request $request)
	{
		// Gathering data and handler
		$post = $request->request->all();
		$handler = $this->getHandler('addon', 'create');

		return $handler->setData($post)->execute();
	}
}
