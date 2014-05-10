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
	    $task = $this->getTask('addon', 'collect')
	        ->setPaging(['page'=>  [1, 5]])
	        ->execute();
	    echo "<pre>";
	    print_r($task);
	    die;
	 
	    return [
		    'name' => $name,
	    ];
    }
}
