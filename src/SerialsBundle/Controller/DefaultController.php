<?php

namespace SerialsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SerialsBundle\Forms\LoginType;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template("Base/Base.html.twig")
     */
    public function indexAction()
    {
        return array(

        );
    }

    /**
     * @Route("/login", name="login")
     * @Template("Sing/Login.html.twig")
     */
    public function loginAction(Request $request){

        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginType::class,array(
            '_username' => $lastUsername
        ));

        return array(
            'form' => $form->createView(),
            'error' => $error
        );

    }
}
