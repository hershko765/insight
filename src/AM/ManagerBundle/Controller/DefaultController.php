<?php

namespace AM\ManagerBundle\Controller;

use Core\Base;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Base\Controller
{
    /**
     * @Route("/{name}")
     * @Template("ManagerBundle:Default:index.html.twig")
     */
    public function indexAction($name = 'roee')
    {
	    return [
		    'name' => $name,
	    ];
    }
}
