<?php

namespace Fpt\StripeBundle\Webhook;

use Fpt\StripeBundle\Exception\WebhookSignatureException;
use Stripe\Exception\SignatureVerificationException;
use Stripe\WebhookSignature;

class WebhookSignatureChecker implements WebhookSignatureCheckerInterface
{
    public function checkSignature(string $payload, string $signatureHeader, string $secret, int $tolerance): void
    {
        try {
            WebhookSignature::verifyHeader($payload, $signatureHeader, $secret, $tolerance);
        } catch (SignatureVerificationException $exception) {
            throw new WebhookSignatureException($exception);
        }
    }
}
