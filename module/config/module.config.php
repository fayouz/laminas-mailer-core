<?php
namespace Fayouz\Laminas\Mailer\Core;

use Fayouz\Laminas\Mailer\Core\Controller\IndexController;
use Fayouz\Laminas\Mailer\Core\Options\ModuleOptions;
use Fayouz\Laminas\Mailer\Core\Options\ModuleOptionsFactory;
use Fayouz\Laminas\Mailer\Core\Service\MailerService;
use Fayouz\Laminas\Mailer\Core\Service\MailerServiceFactory;
use Fayouz\Laminas\Mailer\Core\Service\MailerServiceInterface;
use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;


return [
    'router' =>[
        'routes' => [
            'mail' => [
                'type' => Literal::class,
                'options' =>[
                    'route' => '/mail',
                    'defaults'=>[
                        'controller' => IndexController::class,
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => InvokableFactory::class
        ]
    ],
    'service_manager' => [
        'aliases' => [
            MailerServiceInterface::class => MailerService::class
        ],
        'factories' => [
            ModuleOptions::class => ModuleOptionsFactory::class,
            MailerService::class => MailerServiceFactory::class
        ]
    ]
];
