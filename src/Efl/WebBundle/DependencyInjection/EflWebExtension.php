<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 10/05/14
 * Time: 14:13
 */

namespace Efl\WebBundle\DependencyInjection;

use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\Yaml\Yaml;

class EflWebExtension extends Extension implements PrependExtensionInterface
{
    /**
     * Loads a specific configuration.
     *
     * @param array $config    An array of configuration values
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function load( array $config, ContainerBuilder $container )
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator( __DIR__ . '/../Resources/config' )
        );

        // Base services override
        $loader->load( 'services.yml' );
        // Default settings
        $loader->load( 'default_settings.yml' );

        // Forms
        $loader->load( 'forms.yml' );

        // Menús
        $loader->load( 'menus.yml' );

        // Helpers
        $loader->load( 'helpers.yml' );

        // Fieldtypes
        $loader->load( 'fieldtypes.yml' );

        // Storage Engines
        $loader->load( 'storage_engines.yml' );
    }

    /**
     * Loads EflBundle configuration.
     *
     * @param ContainerBuilder $container
     */
    public function prepend( ContainerBuilder $container )
    {
        $configFile = __DIR__ . '/../Resources/config/efl.yml';
        $config = Yaml::parse( file_get_contents( $configFile ) );
        $container->prependExtensionConfig( 'ezpublish', $config );
        $container->addResource( new FileResource( $configFile ) );
    }

    private function registerRepositoriesConfiguration( array $config, ContainerBuilder $container )
    {
        if ( !isset( $config['repositories'] ) )
        {
            $config['repositories'] = array();
        }

        $container->setParameter( 'ezpublish.repositories', $config['repositories'] );
    }
} 