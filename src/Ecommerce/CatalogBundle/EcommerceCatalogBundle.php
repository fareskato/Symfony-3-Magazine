<?php

namespace Ecommerce\CatalogBundle;

use Ecommerce\CatalogBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EcommerceCatalogBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        // Add the new compilerPass class to the container of the bundle
        $container->addCompilerPass(new OverrideServiceCompilerPass());
    }
}
