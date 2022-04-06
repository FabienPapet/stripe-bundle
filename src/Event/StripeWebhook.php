<?php

namespace Fpt\StripeBundle\Event;

use Stripe\Event;

class StripeWebhook
{
    public function __construct(
        protected Event $stripeObject
    ) {
    }

    public function getStripeObject(): Event
    {
        return $this->stripeObject;
    }

    public function getType(): string
    {
        return $this->stripeObject->type;
    }
}
