<?php

namespace OSEF\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OSEFAppBundle:Default:index.html.twig');
    }
}
