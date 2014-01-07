<?php

namespace Via\Bundle\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ViaProductBundle:Default:index.html.twig', array('name' => $name));
    }
}
