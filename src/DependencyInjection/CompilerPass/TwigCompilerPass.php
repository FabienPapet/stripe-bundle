<?php

namespace Fpt\StripeBundle\DependencyInjection\CompilerPass;

use Fpt\StripeBundle\Twig\StripeExtension;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class TwigCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if ($container->hasDefinition('twig')) {
            $extension = new Definition(StripeExtension::class, [
                '$stripePublishableKey' => $container->getParameter('fpt_stripe.credentials.publishable_key'),
            ]);
            $extension->addTag('twig.extension');

            $container->setDefinition(StripeExtension::class, $extension);
        }
    }
}
