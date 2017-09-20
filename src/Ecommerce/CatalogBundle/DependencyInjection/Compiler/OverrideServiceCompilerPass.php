<?php
/**
 * Created by PhpStorm.
 * User: fkato
 * Date: 20.09.17
 * Time: 17:31
 */

namespace Ecommerce\CatalogBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        /**
         * Override the category_menu core service
         */
        // Remove the old definition from the service container
        $container->removeDefinition('category_menu');
        // Set the new definition
        $container->setDefinition('category_menu', $container->getDefinition('ecommerce_catalog.category_menu'));

        /**
         * Override the core onsale service
         */
        // Remove the old definition from thr container
        $container->removeDefinition('products_onsale');
        // Add new definition to service container
        $container->setDefinition('products_onsale', $container->getDefinition('ecommerce_catalog.onsale'));

    }

}