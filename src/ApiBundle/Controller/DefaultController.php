<?php

namespace ApiBundle\Controller;

use AppWebBundle\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends FOSRestController
{
    /**
     * @Route("/status", name="api_index")
     */
    public function indexAction()
    {
    	$view = $this->view(['sistema' => 'Agenda', 'versao' => 1.0, 'status' => 'Ok'], 200);
    	return $this->handleView($view);
    }

    /**
     * @Route("/authentication", name="api_user_login")
     * @Method({"GET", "POST"})
     */
    public function userLoginAction()
    {
    	$dados = $this->getRequest()->request->all();

    	if (empty($dados)) { 
    		$view = $this->view([ 'info' => 'para fazer login, você deve enviar um json nesse formato', 'json-exemple' => 
    			['email' => 'teste@email.com', 'passwd' => '123456'] ], 200);
    		return $this->handleView($view);
    	}

    	$em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppWebBundle:User')->findOneByEmail($dados['email']);

        if(!$user || !$this->checkPasswd($user, $dados['passwd'])) {
        	$view = $this->view(['error' => 'Usuário ou senha invalidos'], 401);

        	$logger = $this->get('logger');
        	$logger->error('error de login: ', [$dados]);

    		return $this->handleView($view);
        }

    	$view = $this->view(['id' => $user->getId(), 'name' => $user->__toString(), 'email' => $user->getEmail()], 200);
    	return $this->handleView($view);
    }

    private function checkPasswd(User $user, $passwd) {

    	$encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        $passwd_encoded = $encoder->encodePassword($passwd, $user->getSalt());

        return $user->getPassword() == $passwd_encoded;
    }
}
