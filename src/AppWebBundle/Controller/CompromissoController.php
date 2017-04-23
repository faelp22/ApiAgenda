<?php

namespace AppWebBundle\Controller;

use AppWebBundle\Entity\Compromisso;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Compromisso controller.
 *
 * @Route("compromisso")
 */
class CompromissoController extends Controller
{

    use \AppWebBundle\Utils\FormSecurityManager;

    /**
     * Lists all compromisso entities.
     *
     * @Route("/", name="compromisso_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $compromissos = $em->getRepository('AppWebBundle:Compromisso')->findAll();

        return $this->render('AppWebBundle:Compromisso:index.html.twig', array(
            'compromissos' => $compromissos,
        ));
    }

    /**
     * Creates a new compromisso entity.
     *
     * @Route("/new", name="compromisso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $compromisso = new Compromisso();
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $compromisso->setUser($user);

        $dados = $this->getRequest()->request->all();

        if (!empty($dados) && $this->checkCsrfToken($dados['compromisso']['csrf_token'])) { 

            $date = $dados['compromisso']['data'];

            $compromisso->setNome($dados['compromisso']['nome']);
            $compromisso->setDescricao($dados['compromisso']['descricao']);
            $compromisso->setLocal($dados['compromisso']['local']);

            if(!empty($date)) {
                $compromisso->setData(new \DateTime($date));
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($compromisso);
            $em->flush();

            return $this->redirectToRoute('compromisso_show', array('id' => $compromisso->getId()));
        }

        return $this->render('AppWebBundle:Compromisso:new.html.twig', array(
            'compromisso' => $compromisso,
        ));
    }

    /**
     * Finds and displays a compromisso entity.
     *
     * @Route("/{id}", name="compromisso_show")
     * @Method("GET")
     */
    public function showAction(Compromisso $compromisso)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('AppWebBundle:Compromisso:show.html.twig', array(
            'compromisso' => $compromisso
        ));
    }

    /**
     * Displays a form to edit an existing compromisso entity.
     *
     * @Route("/{id}/edit", name="compromisso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Compromisso $compromisso)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $dados = $this->getRequest()->request->all();

        if (!empty($dados) && $this->checkCsrfToken($dados['compromisso']['csrf_token'])) { 

            $date = $dados['compromisso']['data'];

            $compromisso->setNome($dados['compromisso']['nome']);
            $compromisso->setDescricao($dados['compromisso']['descricao']);
            $compromisso->setLocal($dados['compromisso']['local']);
            $compromisso->setSync(0);

            if(!empty($date)) {
                $compromisso->setData(new \DateTime($date));
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($compromisso);
            $em->flush();

            return $this->redirectToRoute('compromisso_show', array('id' => $compromisso->getId()));
        }

        return $this->render('AppWebBundle:Compromisso:edit.html.twig', array(
            'compromisso' => $compromisso
        ));
    }

    /**
     * Deletes a compromisso entity.
     *
     * @Route("/{id}/delete", name="compromisso_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $compromisso = $em->getRepository('AppWebBundle:Compromisso')->find($id);

        if ($compromisso) { 
            $em->remove($compromisso);
            $em->flush();
        }

        return $this->redirectToRoute('compromisso_index');
    }

}
