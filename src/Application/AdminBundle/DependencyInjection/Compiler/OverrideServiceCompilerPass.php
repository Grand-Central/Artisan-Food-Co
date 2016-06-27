<?php

namespace Application\AdminBundle\DependencyInjection\Compiler;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideServiceCompilerPass implements CompilerPassInterface
{
    /**
     * sets show_in_dashboard to false for the passed service definition
     * @param  $definition
     * @return $definition
     */
    private function hideFromDashboard($definition){
        if ( $definition ) {
            if ($definition->hasTag('sonata.admin')) {
                $tags = $definition->getTag( 'sonata.admin' );
                $tags[ 0 ][ 'show_in_dashboard' ] = false;
                $definition->clearTag( 'sonata.admin' );
                $definition->addTag( 'sonata.admin', $tags[ 0 ] );
            }
        }
        return $definition;
    }

    /**
     * The main compiler pass process
     * @param  ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        //override the group menu provider from sonata so we can allow menu items with just an edit route
        $definition = $container->getDefinition('sonata.admin.menu.group_provider');
        $definition->setClass('Application\AdminBundle\Menu\Provider\GroupMenuProvider');

        //hide some admins from the dashboard and menu
        $this->hideFromDashboard($container->getDefinition('sonata.media.admin.gallery'));
        $this->hideFromDashboard($container->getDefinition('sonata.classification.admin.category'));
        $this->hideFromDashboard($container->getDefinition('sonata.classification.admin.tag'));
        $this->hideFromDashboard($container->getDefinition('sonata.classification.admin.collection'));
        $this->hideFromDashboard($container->getDefinition('sonata.classification.admin.context'));
        // $this->hideFromDashboard($container->getDefinition('sonata.user.admin.user'));
        // $this->hideFromDashboard($container->getDefinition('sonata.user.admin.group'));
    }
}
