<?php

namespace Fpt\StripeBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class StripeExtension extends AbstractExtension
{
    public function __construct(
        protected string $stripePublishableKey,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_stripe_publishable_key', [$this, 'getStripePublishableKey'])
        ];
    }

    public function getStripePublishableKey(): string
    {
        return $this->stripePublishableKey;
    }
}
