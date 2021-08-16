<?php

namespace Fayouz\Laminas\Mailer\Core\Service;

use Fayouz\Laminas\Mailer\Core\Adapter\PhpMailerAdapter;
use Fayouz\Laminas\Mailer\Core\Options\ModuleOptions;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 *
 */
class MailerServiceFactory implements FactoryInterface
{
    
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): MailerService
    {
        /** @var ModuleOptions $options */
        $options = $container->get(ModuleOptions::class);
      
        $adapter = $options->getAdapter();
        
        return new MailerService(new $adapter($options->getOptions()));
    }
}
