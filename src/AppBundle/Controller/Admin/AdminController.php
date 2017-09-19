<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends Controller
{
    /**
     * @Route("admin", name="dashboard")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('admin/dashboard.html.twig');
    }

    /**
     * Generate top buttons for all entities
     * @param $add_route
     * @param $list_route
     * @param $entity_type
     * @return array
     */
    protected function generateTopButtons($add_route, $list_route, $entity_type)
    {
        return $top_buttons = [
            'add' => [
                'name' => 'add',
                'class' => 'btn btn-success',
                'icon' => 'fa-plus-circle',
                'url' => $add_route,
                'value' => 'Add '. $entity_type
            ],
            'back' => [
                'name' => 'back',
                'class' => 'btn btn-primary',
                'icon' => 'fa-arrow-circle-left',
                'url' => $list_route,
                'value' => 'Back to list'
            ],

        ];
    }



}
