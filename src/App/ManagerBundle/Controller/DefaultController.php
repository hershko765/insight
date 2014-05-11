<?php

namespace App\ManagerBundle\Controller;

use App\SourceBundle\Base;
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
	    $handler = $this->getHandler('addon', 'collect')
	        ->setPaging(['page'=>  [2, 5]])
	        ->execute();

	    echo "<pre>";
	    print_r($handler);
	    die;

	    return [
		    'name' => $name,
	    ];
    }
}
