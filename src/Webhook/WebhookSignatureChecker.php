<?php

namespace Fpt\StripeBundle\Webhook;

use Fpt\StripeBundle\Exception\WebhookSignatureException;
use Stripe\Exception\SignatureVerificationException;
use Stripe\WebhookSignature;

class WebhookSignatureChecker implements WebhookSignatureCheckerInterface
{
    public function __construct(
        protected string $webhookSecret,
        protected ?int $tolerance = null,
    ) {
    }

    public function checkSignature(string $payload, string $signatureHeader): void
    {
        try {
            WebhookSignature::verifyHeader($payload, $signatureHeader, $this->webhookSecret, $this->tolerance);
        } catch (SignatureVerificationException $exception) {
            throw new WebhookSignatureException($exception);
        }
    }
}
