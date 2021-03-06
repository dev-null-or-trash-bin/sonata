<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            
            new FOS\UserBundle\FOSUserBundle(),
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\jQueryBundle\SonatajQueryBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            
            
            #new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
            new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),
            new JMS\I18nRoutingBundle\JMSI18nRoutingBundle(),
            // not required, but recommended for better extraction
            new JMS\TranslationBundle\JMSTranslationBundle(),
            new Lunetics\LocaleBundle\LuneticsLocaleBundle(),
            new Misd\GuzzleBundle\MisdGuzzleBundle(),

            
            new Via\Bundle\UserBundle\ViaUserBundle(),
            new Via\Bundle\ProductBundle\ViaProductBundle(),
            new Via\Bundle\PropertyBundle\ViaPropertyBundle(),
            new Via\Bundle\GuzzleBundle\ViaGuzzleBundle(),
            new Via\Bundle\ApiBundle\ViaApiBundle(),
            new Via\Bundle\WebBundle\ViaWebBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Elao\WebProfilerExtraBundle\WebProfilerExtraBundle();
            $bundles[] = new Playbloom\Bundle\GuzzleBundle\PlaybloomGuzzleBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
