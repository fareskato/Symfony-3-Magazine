<?php
/**
 * Created by PhpStorm.
 * User: fkato
 * Date: 20.09.17
 * Time: 17:10
 */

namespace Ecommerce\CatalogBundle\Service\Menu;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class OnSale
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
     * Get onsale products
     */
    public function getItems()
    {
        $products = [];
        $_products = $this->em->getRepository("EcommerceCatalogBundle:Product")->findBy(
            ['onsale' => true],
            null,
            5
        );
        foreach ($_products as $_product){
            $products[] = [
                'path' => $this->router->generate('product_show', ['id' =>$_product->getId()]),
                'name' => $_product->getTitle(),
                'image' => $_product->getImage(),
                'price' => $_product->getPrice(),
                'id' => $_product->getId()
            ];
        }
        return $products;
    }

}