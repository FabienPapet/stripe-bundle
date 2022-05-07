<?php

namespace Fpt\StripeBundle\Webhook;

use Fpt\StripeBundle\Exception\WebhookSignatureException;

interface WebhookSignatureCheckerInterface
{
    /**
     * @throws WebhookSignatureException
     */
    public function checkSignature(string $payload, string $signatureHeader): void;
}
