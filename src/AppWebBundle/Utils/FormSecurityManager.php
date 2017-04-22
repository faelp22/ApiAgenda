<?php

namespace AppWebBundle\Utils;

/**
 * Description of FormSecurityManager
 *
 * @author Isael Sousa <faelp22@gmail.com>
 */
trait FormSecurityManager {

    private function getCsrfToken() {
        return $this->container->has('form.csrf_provider') ?
                $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate') : null;
    }

    private function checkCsrfToken($csrf_token) {
        return ($csrf_token !== $this->get('security.csrf.token_manager')->getToken('intention')->getValue()) ? true : false;
    }

}
