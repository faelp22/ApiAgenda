<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends FOSRestController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
    	$view = $this->view(['sistema' => 'Agenda', 'versao' => 1.0, 'status' => 'Ok'], 200);
    	return $this->handleView($view);
    }
}
