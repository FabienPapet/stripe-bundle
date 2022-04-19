<?php

namespace Fpt\StripeBundle\Webhook;

class NullSignatureChecker implements WebhookSignatureCheckerInterface
{
    public function checkSignature(string $payload, string $signatureHeader, string $secret, int $tolerance): void
    {
    }
}
