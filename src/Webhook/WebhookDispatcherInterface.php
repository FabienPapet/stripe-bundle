<?php

namespace Fpt\StripeBundle\Webhook;

use Fpt\StripeBundle\Event\StripeWebhook;

interface WebhookDispatcherInterface
{
    public function dispatch(StripeWebhook $webhook);
}
