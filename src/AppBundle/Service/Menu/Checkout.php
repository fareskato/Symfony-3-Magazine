<?php
/**
 * Created by PhpStorm.
 * User: fkato
 * Date: 19.09.17
 * Time: 16:02
 */

namespace AppBundle\Service\Menu;


class Checkout
{

    public function getItems()
    {
        return [
            ['path' => 'cart' , 'label' => 'Cart (3)'],
            ['path' => 'checkout' , 'label' => 'Checkout'],
        ];
    }

}