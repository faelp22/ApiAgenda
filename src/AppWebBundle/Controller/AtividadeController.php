<?php

namespace AppWebBundle\Controller;

use AppWebBundle\Entity\Atividade;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Atividade controller.
 *
 * @Route("atividade")
 */
class AtividadeController extends Controller
{

    use \AppWebBundle\Utils\FormSecurityManager;

    /**
     * Lists all atividade entities.
     *
     * @Route("/", name="atividade_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $atividades = $em->getRepository('AppWebBundle:Atividade')->findAll();

        return $this->render('AppWebBundle:Atividade:index.html.twig', array(
            'atividades' => $atividades,
        ));
    }

    /**
     * Creates a new atividade entity.
     *
     * @Route("/new", name="atividade_new")
     * @Method({"GET", "POST"})
     */
    public function newAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $atividade = new Atividade();
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $atividade->setUser($user);

        $dados = $this->getRequest()->request->all();

        if (!empty($dados) && $this->checkCsrfToken($dados['atividade']['csrf_token'])) { 

            $date = $dados['atividade']['prazo'];

            $atividade->setNome($dados['atividade']['nome']);
            $atividade->setDescricao($dados['atividade']['descricao']);

            if(!empty($date)) {
                $atividade->setPrazo(new \DateTime($date));
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($atividade);
            $em->flush();

            return $this->redirectToRoute('atividade_show', array('id' => $atividade->getId()));
        }

        return $this->render('AppWebBundle:Atividade:new.html.twig', array(
            'atividade' => $atividade,
        ));
    }

    /**
     * Finds and displays a atividade entity.
     *
     * @Route("/{id}", name="atividade_show")
     * @Method("GET")
     */
    public function showAction(Atividade $atividade)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('AppWebBundle:Atividade:show.html.twig', array(
            'atividade' => $atividade
        ));
    }

    /**
     * Displays a form to edit an existing atividade entity.
     *
     * @Route("/{id}/edit", name="atividade_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Atividade $atividade)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $dados = $this->getRequest()->request->all();

        if (!empty($dados) && $this->checkCsrfToken($dados['atividade']['csrf_token'])) { 

            $date = $dados['atividade']['prazo'];
            
            $atividade->setNome($dados['atividade']['nome']);
            $atividade->setDescricao($dados['atividade']['descricao']);
            $atividade->setSync(0);

            if(!empty($date)) {
                $atividade->setPrazo(new \DateTime($date));
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($atividade);
            $em->flush();

            return $this->redirectToRoute('atividade_edit', array('id' => $atividade->getId()));
        }


        return $this->render('AppWebBundle:Atividade:edit.html.twig', array(
            'atividade' => $atividade
        ));
    }

    /**
     * Deletes a atividade entity.
     *
     * @Route("/{id}/delete", name="atividade_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $atividade = $em->getRepository('AppWebBundle:Atividade')->find($id);

        if ($atividade) { 
            $em->remove($atividade);
            $em->flush();
        }

        return $this->redirectToRoute('atividade_index');
    }

}
