<?php

namespace App\ManagerBundle\Controller;
use App\SourceBundle\Base;

use App\SourceBundle\Helpers\Arr;
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
     * @Route("/")
     * @Template("ManagerBundle:Default:index.html.twig")
     */
    public function indexAction(Request $request)
    {
		$credentials = json_decode($request->cookies->get('user') ?: '{}', TRUE);
		$user = $this->getHandler('Auth', 'Login', 'User')->setCredentials($credentials)->execute();
		$user = Arr::get($user, 0);
	    if ( ! $user)
		    return $this->redirect('/login');
		
		unset($user['password']);

	    return [
		    'user' => $user
	    ];
    }
}
