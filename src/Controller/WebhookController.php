<?php

namespace Fpt\StripeBundle\Controller;

use Fpt\StripeBundle\Event\StripeWebhook;
use Fpt\StripeBundle\Exception\WebhookSignatureException;
use Fpt\StripeBundle\Webhook\WebhookDispatcherInterface;
use Fpt\StripeBundle\Webhook\WebhookSignatureCheckerInterface;
use Stripe\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class WebhookController
{
    public function __construct(
        private WebhookDispatcherInterface $webhookDispatcher,
        private WebhookSignatureCheckerInterface $signatureChecker,
        private string $webhookSignature
    ) {
    }

    public function __invoke(Request $request): Response
    {
        try {
            $content = (string) $request->getContent();
            $header = (string) $request->headers->get('STRIPE_SIGNATURE', '');
            $this->signatureChecker->checkSignature($content, $header, $this->webhookSignature, 300);

            $event = Event::constructFrom(\json_decode($content, true, 512, JSON_THROW_ON_ERROR));

            $webhookEvent = new StripeWebhook($event);
            $this->webhookDispatcher->dispatch($webhookEvent);
        } catch (\JsonException|WebhookSignatureException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($webhookEvent->hasResponse()) {
            /** @var Response */
            return $webhookEvent->getResponse();
        }

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
