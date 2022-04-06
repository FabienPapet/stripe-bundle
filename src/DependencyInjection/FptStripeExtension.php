<?php

namespace Fpt\StripeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
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
        $container->setParameter('fpt_stripe.credentials.public_key', $config['credentials']['public_key']);
        $container->setParameter('fpt_stripe.credentials.secret_key', $config['credentials']['secret_key']);
        $container->setParameter('fpt_stripe.credentials.webhook_signature_key', $config['credentials']['webhook_signature_key']);
    }
}
