<?php

namespace Fpt\StripeBundle\Webhook;

use Fpt\StripeBundle\Event\StripeWebhook;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class EventWebhookDispatcher implements WebhookDispatcherInterface
{
    public function __construct(
        private EventDispatcherInterface $dispatcher
    ) {
    }

    public function dispatch(StripeWebhook $webhook): void
    {
        $this->dispatcher->dispatch($webhook, sprintf('stripe.%s', $webhook->getType()));
    }
}
