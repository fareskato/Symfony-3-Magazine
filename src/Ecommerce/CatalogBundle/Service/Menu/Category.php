<?php
/**
 * Created by PhpStorm.
 * User: fkato
 * Date: 20.09.17
 * Time: 17:07
 */

namespace Ecommerce\CatalogBundle\Service\Menu;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class Category
{
    private $em;
    private $router;

    public function __construct(EntityManager $entityManager, Router $router)
    {
        $this->em = $entityManager;
        $this->router = $router;
    }

    /**
     * @return array
     * Create label and path for all categories
     */
    public function getItems()
    {
        $categories = [];
        $_categories = $this->em->getRepository("EcommerceCatalogBundle:Category")->findAll();
        foreach ($_categories as $_category){
            $categories[] = [
                'path' => $this->router->generate('category_show', ['id' => $_category->getId()]),
                'label' => $_category->getTitle()
            ];
        }
        return $categories;
    }


}