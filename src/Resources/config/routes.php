<?php

use Fpt\StripeBundle\Controller\WebhookController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routingConfigurator) {
    $routingConfigurator
        ->add('stripe_webhooks', '/stripe/webhooks')
        ->methods(['POST'])
        ->controller([WebhookController::class, '__invoke'])
    ;
};
