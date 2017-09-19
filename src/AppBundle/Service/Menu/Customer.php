<?php
/**
 * Created by PhpStorm.
 * User: fkato
 * Date: 19.09.17
 * Time: 16:02
 */

namespace AppBundle\Service\Menu;


class Customer
{

    public function getItems()
    {
        return [
            ['path' =>'account', 'label' =>'John Doe'],
            ['path' =>'logout', 'label' =>'Logout'],
        ];
    }

}