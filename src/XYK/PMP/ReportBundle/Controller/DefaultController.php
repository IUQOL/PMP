<?php

namespace XYK\PMP\ReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ReportBundle:Default:index.html.twig', array('name' => $name));
    }
}
