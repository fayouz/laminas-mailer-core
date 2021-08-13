<?php
namespace Fayouz\Laminas\Mailer\Core;

use Fayouz\Laminas\Mailer\Core\Service\MailerService;
use Fayouz\Laminas\Mailer\Core\Service\MailerServiceFactory;
use Fayouz\Laminas\Mailer\Core\Service\MailerServiceInterface;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'aliases' => [
            MailerServiceInterface::class => MailerService::class
        ],
        'factories' => [
            MailerService::class => MailerServiceFactory::class
        ]
    ]
];
