<?php

namespace ApiBundle\Controller;

use AppWebBundle\Entity\Contato;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Contato controller.
 *
 * @Route("contato")
 */
class ContatoController extends FOSRestController
{

    /**
     * Lists all contato entities.
     *
     * @Route("/user/{user_id}", name="api_contato_index")
     * @Method("GET")
     */
    public function indexAction($user_id)
    {
        
        $em = $this->getDoctrine()->getManager();

        $contatos = $em->getRepository('AppWebBundle:Contato')->findByUserId($user_id);

        $view = $this->view($contatos, 200);
        return $this->handleView($view);
    }

    /**
     * Finds and displays a contato entity.
     *
     * @Route("/{id}/user/{user_id}", name="api_contato_show")
     * @Method("GET")
     */
    public function showAction($id, $user_id)
    {
        $em = $this->getDoctrine()->getManager();

        $contato = $em->getRepository('AppWebBundle:Contato')->findByIdAndUserId($id, $user_id);

        $view = $this->view($contato, 200);
        return $this->handleView($view);
    }

}
