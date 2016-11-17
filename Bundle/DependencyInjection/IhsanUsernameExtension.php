<?php

namespace Ihsan\UsernameGenerator\Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class IhsanUsernameExtension extends Extension
{
    const ALIAS = 'ihsan_username';

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $container->setParameter('ihsan.username.user_class', $config['user_class']);

        $definition = $container->getDefinition('ihsan.username.generator_factory');
        $definition->replaceArgument(0, new Reference($config['user_repository']));
    }

    public function getAlias()
    {
        return self::ALIAS;
    }
}
