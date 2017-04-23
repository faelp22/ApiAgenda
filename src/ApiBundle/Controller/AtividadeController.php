<?php

namespace ApiBundle\Controller;

use AppWebBundle\Entity\Atividade;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Atividade controller.
 *
 * @Route("atividade")
 */
class AtividadeController extends FOSRestController
{

    /**
     * Lists all atividade entities.
     *
     * @Route("/user/{user_id}", name="api_atividade_index")
     * @Method("GET")
     */
    public function indexAction($user_id)
    {
        $em = $this->getDoctrine()->getManager();

        $atividades = $em->getRepository('AppWebBundle:Atividade')->findByUserId($user_id);

        $view = $this->view($atividades, 200);
        return $this->handleView($view);
    }

    /**
     * Finds and displays a atividade entity.
     *
     * @Route("/{id}/user/{user_id}", name="api_atividade_show")
     * @Method("GET")
     */
    public function showAction($id, $user_id)
    {
        $em = $this->getDoctrine()->getManager();

        $atividade = $em->getRepository('AppWebBundle:Atividade')->findByIdAndUserId($id, $user_id);
        
        $view = $this->view($atividade, 200);
        return $this->handleView($view);
    }

}
