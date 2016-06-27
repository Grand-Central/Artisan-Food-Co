<?php

namespace Application\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    // /**
    //  * @Route("/admin/login")
    //  * @Template()
    //  */
    // public function loginAction()
    // {
    //     $request = $this->container->get('request');
    //     /* @var $request \Symfony\Component\HttpFoundation\Request */
    //     $session = $request->getSession();
    //     /* @var $session \Symfony\Component\HttpFoundation\Session */

    //     // get the error if any (works with forward and redirect -- see below)
    //     if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
    //         $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
    //     } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
    //         $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
    //         $session->remove(SecurityContext::AUTHENTICATION_ERROR);
    //     } else {
    //         $error = '';
    //     }

    //     if ($error) {
    //         // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
    //         $error = $error->getMessage();
    //     }
    //     // last username entered by the user
    //     $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

    //     $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

    //     return $this->render('ApplicationAdminBundle:Login:login.html.twig', array(
    //         'last_username' => $lastUsername,
    //         'error'         => $error,
    //         'csrf_token' => $csrfToken,
    //     ));
    // }

    // /**
    //  * @Route("/admin/login-check-role")
    //  * @Template()
    //  */
    // public function loginCheckRoleAction()
    // {
    //     //user just logged in, redirect based on role
    //     $user = $this->get('security.context')->getToken()->getUser();

    //     // if($user->hasRole('ROLE_CMS_CONTENT')){
    //     //     return $this->redirect($this->generateUrl('admin_content_page_page_list'));
    //     // }

    //     return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
    // }
}
