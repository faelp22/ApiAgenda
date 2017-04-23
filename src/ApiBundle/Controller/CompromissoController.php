<?php

namespace ApiBundle\Controller;

use AppWebBundle\Entity\Compromisso;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Compromisso controller.
 *
 * @Route("compromisso")
 */
class CompromissoController extends FOSRestController
{

    /**
     * Lists all compromisso entities.
     *
     * @Route("/user/{user_id}", name="api_compromisso_index")
     * @Method("GET")
     */
    public function indexAction($user_id)
    {
        $em = $this->getDoctrine()->getManager();

        $compromissos = $em->getRepository('AppWebBundle:Compromisso')->findByUserId($user_id);

        $view = $this->view($compromissos, 200);
        return $this->handleView($view);
    }

    /**
     * Finds and displays a compromisso entity.
     *
     * @Route("/{id}/user/{user_id}", name="api_compromisso_show")
     * @Method("GET")
     */
    public function showAction($id, $user_id)
    {
        $em = $this->getDoctrine()->getManager();

        $compromisso = $em->getRepository('AppWebBundle:Compromisso')->findByIdAndUserId($id, $user_id);

        $view = $this->view($compromisso, 200);
        return $this->handleView($view);
    }

}
