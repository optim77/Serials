<?php

namespace SerialsBundle\Controller;

use SerialsBundle\Entity\User;
use SerialsBundle\Forms\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use SerialsBundle\Forms\LoginType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
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
            'error' => $error,
            'type' => 'login'
        );

    }

    /**
     * @Route("/register", name="register")
     * @Template("Sing/Login.html.twig")
     */
    public function registerAction(Request $request){

        $User = new User();
        $form = $this->createForm(RegisterType::class,$User);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(null !== $User->getId()){
                throw new Exception('That user already exist');
            }
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($User, $User->getPlainPassword());
            $User->setPassword($encoded);
            $token = substr(md5(uniqid(NULL,TRUE)),0,20);
            $User->setActionToken($token);
            $msgBody = $this->renderView('Emails/Confirm.html.twig',array(
                'token' => $token
            ));

            $messagee = (new \Swift_Message('Confirm your account'))
                ->setFrom('defaultadres@default.com')
                ->setTo($User->getEmail())
                ->setBody($msgBody);

            $this->get('mailer')->send($messagee);

            $em = $this->getDoctrine()->getManager();
            $em->persist($User);
            $em->flush();

            return $this->redirectToRoute('index');
        }
        return array(
            'form' => $form->createView(),
            'type' => 'reg'
        );
    }
}
