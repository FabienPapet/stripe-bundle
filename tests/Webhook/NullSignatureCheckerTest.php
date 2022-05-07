<?php

namespace Fpt\StripeBundle\Tests\Webhook;

use Fpt\StripeBundle\Webhook\NullSignatureChecker;
use PHPUnit\Framework\TestCase;

class NullSignatureCheckerTest extends TestCase
{
    public function testDoesNothing(): void
    {
        $signatureChecker = new NullSignatureChecker();
        $signatureChecker->checkSignature('some payload', 'signature');

        self::assertTrue(true);
    }
}
