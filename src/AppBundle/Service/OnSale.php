<?php
/**
 * Created by PhpStorm.
 * User: fkato
 * Date: 19.09.17
 * Time: 16:05
 */

namespace AppBundle\Service;


class OnSale
{
    public function getItems()
    {
        return [
            [
                'path' => 'iphone',
                'name' => 'Iphone',
                'img' => '/img/missing-image.png',
                'price' => '29.99',
                'add_to_cart_url' => '#',
            ],
            [
                'path' => 'lg',
                'name' => 'LG',
                'img' => '/img/missing-image.png',
                'price' => '19.95',
                'add_to_cart_url' => '#',
            ],
            [
                'path' => 'samsung',
                'name' => 'Samsung',
                'img' => '/img/missing-image.png',
                'price' => '15.95',
                'add_to_cart_url' => '#',
            ],
            [
                'path' => 'lumia',
                'name' => 'Lumia',
                'img' => '/img/missing-image.png',
                'price' => '36.23',
                'add_to_cart_url' => '#',
            ],
        ];
    }

}