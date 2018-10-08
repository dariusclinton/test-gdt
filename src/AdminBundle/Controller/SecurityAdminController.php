<?php
/**
 * Created by PhpStorm.
 * User: dariuso
 * Date: 08/10/18
 * Time: 13:29
 */

namespace AdminBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SecurityAdminController extends Controller
{
    /**
     * @Route("/login", name="admin_login")
     */
    public function loginAction()
    {
        if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->redirectToRoute('sonata_admin_dashboard');
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('AdminBundle:Security:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

    /**
     * @Route("/login_check", name="admin_login_check")
     */
    public function logoutAction()
    {
        throw new \Exception('This should never be reached!');
    }

    /**
     * @Route("/logout", name="admin_logout")
     */
    public function loginCheckAction()
    {
        throw new \Exception('This should never be reached!');
    }
}