<?php

namespace Fpt\StripeBundle\Controller;

use Fpt\StripeBundle\Event\StripeWebhook;
use Fpt\StripeBundle\Webhook\WebhookDispatcherInterface;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Exception\UnexpectedValueException;
use Stripe\Webhook;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class WebhookController
{
    public function __construct(
        private WebhookDispatcherInterface $webhookDispatcher,
        private string $webhookSignature
    ) {
    }

    public function __invoke(Request $request): Response
    {
        try {
            $event = Webhook::constructEvent(
                (string) $request->getContent(),
                (string) $request->headers->get('STRIPE_SIGNATURE', ''),
                $this->webhookSignature
            );

            $this->webhookDispatcher->dispatch(new StripeWebhook($event));
        } catch (UnexpectedValueException|SignatureVerificationException) {
            throw new BadRequestHttpException();
        }

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
