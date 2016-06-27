<?php

namespace Application\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Application\AdminBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;

class ApplicationAdminBundle extends Bundle
{
	/**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new OverrideServiceCompilerPass());
    }
}
