<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            //my own admin bundle to extend and override the Sonta Admin bundle
            new Application\AdminBundle\ApplicationAdminBundle(),

            //Symfony framework related
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Snc\RedisBundle\SncRedisBundle(),

            //sonata admin related
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\IntlBundle\SonataIntlBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
            new Sonata\ClassificationBundle\SonataClassificationBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Application\Sonata\ClassificationBundle\ApplicationSonataClassificationBundle(),
            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Sonata\FormatterBundle\SonataFormatterBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Sonata\SeoBundle\SonataSeoBundle(),

            //other useful bundles
            new SunCat\MobileDetectBundle\MobileDetectBundle(),

            //project specific bundles
            new GrandCentral\PageBundle\GrandCentralPageBundle(),
            new Application\ContactFormBundle\ApplicationContactFormBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    // // this is to speed up Symfony when using vagrant
    // // we basically tell it to use shared memory for cache
    // public function getCacheDir()
    // {
    //     if (in_array($this->environment, array('dev', 'test'))) {
    //         return '/dev/shm/symfony/cache/' .  $this->environment;
    //     }

    //     return parent::getCacheDir();
    // }

    // // this is to speed up Symfony when using vagrant
    // // we basically tell it to use shared memory for logs
    // public function getLogDir()
    // {
    //     if (in_array($this->environment, array('dev', 'test'))) {
    //         return '/dev/shm/symfony/logs';
    //     }

    //     return parent::getLogDir();
    // }
}
