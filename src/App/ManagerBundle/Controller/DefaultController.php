<?php

namespace App\ManagerBundle\Controller;

use App\SourceBundle\Base;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations;

// Annotation Dependency
use FOS\RestBundle\Request\ParamFetcherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;



class DefaultController extends Base\Controller
{
    /**
     * @Route("/{name}")
     * @Template("ManagerBundle:Default:index.html.twig")
     */
    public function indexAction($name = 'roee')
    {
	    $handler = $this->getHandler('addon', 'collect')->setFilters(['category' => 2])->execute();

	    return [
		    'name' => $name,
	    ];
    }
}
