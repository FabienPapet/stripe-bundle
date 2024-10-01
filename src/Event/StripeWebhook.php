<?php

namespace Fpt\StripeBundle\Event;

use Stripe\Event;
use Symfony\Component\HttpFoundation\Response;

class StripeWebhook extends \Symfony\Contracts\EventDispatcher\Event
{
    private ?Response $response = null;

    public function __construct(
        protected Event $stripeObject,
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

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function hasResponse(): bool
    {
        return $this->response instanceof Response;
    }

    public function setResponse(?Response $response): void
    {
        $this->response = $response;
    }
}
