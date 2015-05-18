<?php

namespace XYK\PMP\EntityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EntityBundle:Default:index.html.twig', array('name' => $name));
    }
}
