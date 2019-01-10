<?php

namespace XYK\PMP\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:Default:index.html.twig');
    }
    
    public function gameAction()
    {
        return $this->render('MainBundle:Forms:game.html.twig');
    }
}
