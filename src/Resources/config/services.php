<?php

use Fpt\StripeBundle\Controller\WebhookController;
use Fpt\StripeBundle\Webhook\EventWebhookDispatcher;
use Fpt\StripeBundle\Webhook\WebhookDispatcherInterface;
use Fpt\StripeBundle\Webhook\WebhookSignatureCheckerInterface;
use Stripe\StripeClient;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\param;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->defaults()
            ->autowire(true)
            ->autoconfigure(true)
    ;

    $container->services()
        ->set(WebhookController::class)
            ->public()
            ->args([
                service(WebhookDispatcherInterface::class),
                service(WebhookSignatureCheckerInterface::class),
                service('logger')->nullOnInvalid(),
            ])
            ->tag('controller.service_arguments')
        ->set(StripeClient::class)
        ->lazy()
        ->args([
            param('fpt_stripe.credentials.secret_key'),
        ])

        ->set(WebhookDispatcherInterface::class, EventWebhookDispatcher::class)
        ->autowire()
    ;
};
