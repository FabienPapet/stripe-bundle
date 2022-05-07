<?php

namespace Fpt\StripeBundle\Tests\DependencyInjection;

use Fpt\StripeBundle\DependencyInjection\FptStripeExtension;
use Fpt\StripeBundle\Webhook\NullSignatureChecker;
use Fpt\StripeBundle\Webhook\WebhookSignatureChecker;
use Fpt\StripeBundle\Webhook\WebhookSignatureCheckerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FptStripeExtensionTest extends TestCase
{
    public function testConfiguration(): void
    {
        $container = new ContainerBuilder();
        $fptExtension = new FptStripeExtension();
        $fptExtension->build($container, [
            'credentials' => [
                'publishable_key' => 'pk_test',
                'secret_key' => 'sk_test'
            ],
            'webhook' => [
                'signature_key' => 'wh_sec_',
                'check_signature' => true,
            ],
        ]);

        $definition = $container->getDefinition(WebhookSignatureCheckerInterface::class);

        self::assertSame(['$webhookSecret' => 'wh_sec_'], $definition->getArguments());
        self::assertSame(WebhookSignatureChecker::class, $definition->getClass());
    }

    public function testConfigurationWebhookDisabled(): void
    {
        $container = new ContainerBuilder();
        $fptExtension = new FptStripeExtension();
        $fptExtension->build($container, [
            'credentials' => [
                'publishable_key' => 'pk_test',
                'secret_key' => 'sk_test'
            ],
            'webhook' => [
                'signature_key' => 'wh_sec_',
                'check_signature' => false,
            ],
        ]);

        $definition = $container->getDefinition(WebhookSignatureCheckerInterface::class);

        self::assertSame(NullSignatureChecker::class, $definition->getClass());
    }
}
