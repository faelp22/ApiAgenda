<?php

namespace AppWebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
    	if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        // if($this->get('security.authorization_checker')->isGranted('ROLE_FORCEPASSWORDCHANGE')) {
        //     return $this->redirectToRoute('chamados_index');
        // }
        
        // $securityContext = $this->get('security.context');

        // if (!$securityContext->isGranted(['ROLE_USER'])) {
        //     return $this->render('Exception/error403.html.twig', array(
        //         'URLBASE' => URLBASE,
        //     ));
        // }

        return $this->render('AppWebBundle:Default:index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
}
