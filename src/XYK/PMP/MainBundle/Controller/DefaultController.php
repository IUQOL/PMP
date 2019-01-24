<?php

namespace XYK\PMP\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $this->translator = $this->container->get('translator');
        $security = $this->container->get('security.context'); //->isGranted('ROLE_SUPER_ADMIN');
        $token = $security->getToken();
     
        
        $idTypeExam = $token->getUser()->getExamType()->getId();
        return $this->render('MainBundle:Default:index.html.twig' , 
                    array(
                        'idExamType' => $idTypeExam

                    ));
    }
    
    public function gameAction()
    {
        return $this->render('MainBundle:Forms:game.html.twig');
    }
}
