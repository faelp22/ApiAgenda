<?php

namespace AppWebBundle\Controller;

use AppWebBundle\Entity\Contato;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Contato controller.
 *
 * @Route("contato")
 */
class ContatoController extends Controller
{

    use \AppWebBundle\Utils\FormSecurityManager;

    /**
     * Lists all contato entities.
     *
     * @Route("/", name="contato_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        $em = $this->getDoctrine()->getManager();

        $contatos = $em->getRepository('AppWebBundle:Contato')->findAll();

        return $this->render('AppWebBundle:Contato:index.html.twig', array(
            'contatos' => $contatos,
        ));
    }

    /**
     * Creates a new contato entity.
     *
     * @Route("/new", name="contato_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $contato = new Contato();
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $contato->setUser($user);        

        $dados = $this->getRequest()->request->all();

        if (!empty($dados) && $this->checkCsrfToken($dados['contato']['csrf_token'])) { 
            
            $contato->setNome($dados['contato']['nome']);
            $contato->setEmail($dados['contato']['email']);
            $contato->setTelefone($this->limparField($dados['contato']['telefone']));

            $em = $this->getDoctrine()->getManager();
            $em->persist($contato);
            $em->flush();

            return $this->redirectToRoute('contato_show', array('id' => $contato->getId()));
        }

        return $this->render('AppWebBundle:Contato:new.html.twig', array(
            'contato' => $contato,
        ));
    }

    /**
     * Finds and displays a contato entity.
     *
     * @Route("/{id}", name="contato_show")
     * @Method("GET")
     */
    public function showAction(Contato $contato)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('AppWebBundle:Contato:show.html.twig', array(
            'contato' => $contato
        ));
    }

    /**
     * Displays a form to edit an existing contato entity.
     *
     * @Route("/{id}/edit", name="contato_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Contato $contato)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $dados = $this->getRequest()->request->all();

        if (!empty($dados) && $this->checkCsrfToken($dados['contato']['csrf_token'])) { 

            $contato->setNome($dados['contato']['nome']);
            $contato->setEmail($dados['contato']['email']);
            $contato->setTelefone($this->limparField($dados['contato']['telefone']));

            $em = $this->getDoctrine()->getManager();
            $em->persist($contato);
            $em->flush();

            return $this->redirectToRoute('contato_show', array('id' => $contato->getId()));
        }

        return $this->render('AppWebBundle:Contato:edit.html.twig', array(
            'contato' => $contato
        ));
    }

    /**
     * Deletes a contato entity.
     *
     * @Route("/{id}/delete", name="contato_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $contato = $em->getRepository('AppWebBundle:Contato')->find($id);

        if ($contato) { 
            $em->remove($contato);
            $em->flush();
        }

        return $this->redirectToRoute('contato_index');
    }
    
    private function limparField($val) {
        return str_replace(['.', '-', ')', '(', '}', '{', ' '], '', $val);
    }
}
