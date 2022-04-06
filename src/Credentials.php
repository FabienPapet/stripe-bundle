<?php

namespace Fpt\StripeBundle;

class Credentials
{
    public function __construct(
        private string $publicKey,
        private string $secretKey
    ) {
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }
}
