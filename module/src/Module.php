<?php

namespace Fayouz\Laminas\Mailer\Core;

use Laminas\Loader\StandardAutoloader;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

/**
 *
 */
class Module implements ConfigProviderInterface
{
    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__.'/../config/module.config.php';
    }
    
    /**
     * @return \array[][]
     */
    public function getAutoloaderConfig()
    {
        return [
            StandardAutoloader::class => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__,
                ],
            ],
        ];
    }
    
}
