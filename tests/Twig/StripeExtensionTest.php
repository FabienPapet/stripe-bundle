<?php

namespace Fpt\StripeBundle\Tests\Twig;

use Fpt\StripeBundle\Twig\StripeExtension;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class StripeExtensionTest extends TestCase
{
    public function testGetPublishableKey(): void
    {
        $extension = new StripeExtension('pk_test');
        self::assertEquals('pk_test', $extension->getStripePublishableKey());
    }

    public function testExtension(): void
    {
        $extension = new StripeExtension('pk_test');

        $twig = new Environment(new ArrayLoader(['template' => 'some text {{ get_stripe_publishable_key() }}']), [
            'debug' => true,
            'cache' => false,
            'optimizations' => 0,
        ]);
        $twig->addExtension($extension);

        self::assertEquals('some text pk_test', $twig->render('template'));
    }
}
