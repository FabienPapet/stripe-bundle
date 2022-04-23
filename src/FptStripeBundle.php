<?php

namespace Fpt\StripeBundle;

use Fpt\StripeBundle\DependencyInjection\CompilerPass\TwigCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FptStripeBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new TwigCompilerPass());
    }
}
