<?php

namespace Fpt\StripeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WebhookControllerTest extends KernelTestCase
{
    public function testWebhook(): void
    {
        self::assertTrue(true);
        $kernel = static::createKernel();
        $kernel->boot();

//        $response = $client->request('GET', '/stripe/webhook');

//        var_dump($client->getContainer()->get(\Fpt\StripeBundle\Controller\WebhookController::class));
//        self::assertResponseStatusCodeSame(200);
    }
}
