<?php

namespace Ecommerce\CatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EcommerceCatalogBundle:Default:index.html.twig');
    }
}
