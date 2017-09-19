<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Frontend Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }
    /**
     * @Route("/customer-services", name="customer-services")
     */
    public function customersAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/customers.html.twig');
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/contact.html.twig');
    }
    /**
     * @Route("/about", name="about")
     */
    public function aboutAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/about.html.twig');
    }
    /**
     * @Route("/orders-and-returns", name="orders-and-returns")
     */
    public function ordersAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/orders.html.twig');
    }
    /**
     * @Route("/privacy-policy", name="privacy-policy")
     */
    public function privacyAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/privacy.html.twig');
    }
}
