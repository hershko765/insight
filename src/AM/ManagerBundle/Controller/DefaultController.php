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
		$addonCollect = $this->getTask('addon', 'collect')
			->setData( [ 'select' => [ 'id', 'addon' ] ] )
			->execute();

	    return [
		    'name' => $name,
	    ];
    }
}
