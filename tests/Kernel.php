<?php

namespace Fpt\StripeBundle\Tests;

use Fpt\StripeBundle\StripeBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as KernelAlias;

class Kernel extends KernelAlias
{
    use MicroKernelTrait;

    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
            new StripeBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->loadFromExtension('framework', [
                'test' => true,
            ]);

            $container->loadFromExtension('fpt_stripe', [
                'credentials' => [
                    'publishable_key' => 'test',
                    'secret_key' => 'test',
                    'webhook_signature_key' => 'test',
                ],
            ]);
        });
    }
}
