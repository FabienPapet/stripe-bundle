<?php

namespace Fpt\StripeBundle\DependencyInjection;

use Fpt\StripeBundle\Webhook\NullSignatureChecker;
use Fpt\StripeBundle\Webhook\WebhookSignatureChecker;
use Fpt\StripeBundle\Webhook\WebhookSignatureCheckerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class FptStripeExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'config'));
        $config = $this->processConfiguration(new Configuration(), $configs);
        $loader->load('services.php');

        $this->build($container, $config);
    }

    private function build(ContainerBuilder $container, array $config): void
    {
        $container->setParameter('fpt_stripe.credentials.publishable_key', $config['credentials']['publishable_key']);
        $container->setParameter('fpt_stripe.credentials.secret_key', $config['credentials']['secret_key']);
        $container->setParameter('fpt_stripe.credentials.webhook_signature_key', $config['credentials']['webhook_signature_key']);
        $container->setParameter('fpt_stripe.webhook.check_signature', $config['webhook']['check_signature']);

        $enableSignature = (bool) $config['webhook']['check_signature'];

        if ($enableSignature) {
            $definition = new Definition(WebhookSignatureChecker::class);
        } else {
            $definition = new Definition(NullSignatureChecker::class);
        }

        $container->setDefinition(WebhookSignatureCheckerInterface::class, $definition);
    }
}
