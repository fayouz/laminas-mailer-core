<?php

namespace Fayouz\Laminas\Mailer\Core\Options;


use Fayouz\Laminas\Mailer\Core\Exception\RuntimeException;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 *
 */
class ModuleOptionsFactory implements FactoryInterface
{
    
    /**
     * @inheritDoc
     * @throws RuntimeException
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('config');
        $config = $config['fayouz-laminas-mailer-core'] ?? null;
    
        if(!isset($config)) {
            throw new RuntimeException('Configuration Missing');
        }
        
        return new ModuleOptions($config);
    }
}
