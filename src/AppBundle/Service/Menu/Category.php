<?php
/**
 * Created by PhpStorm.
 * User: fkato
 * Date: 19.09.17
 * Time: 16:02
 */

namespace AppBundle\Service\Menu;


class Category
{
    public function getItems()
    {
        return [
            ['path' => 'women', 'label' => 'Women'],
            ['path' => 'men', 'label' => 'Men'],
            ['path' => 'sport', 'label' => 'Sport'],
        ];
    }
}