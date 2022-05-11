<?php

namespace Fpt\StripeBundle\Controller;

use Fpt\StripeBundle\Event\StripeWebhook;
use Fpt\StripeBundle\Exception\WebhookSignatureException;
use Fpt\StripeBundle\Webhook\WebhookDispatcherInterface;
use Fpt\StripeBundle\Webhook\WebhookSignatureCheckerInterface;
use JsonException;
use Psr\Log\LoggerInterface;
use Stripe\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class WebhookController
{
    public function __construct(
        private WebhookDispatcherInterface $webhookDispatcher,
        private WebhookSignatureCheckerInterface $signatureChecker,
        private ?LoggerInterface $logger = null,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $content = (string) $request->getContent();
        $header = (string) $request->headers->get('STRIPE_SIGNATURE', '');
        try {
            $this->signatureChecker->checkSignature($content, $header);

            $this->logger?->info('Signature verification complete');

            $event = Event::constructFrom(\json_decode($content, true, 512, JSON_THROW_ON_ERROR));
            $this->logger?->info('Stripe event handled', [
                'event_id' => $event->id,
                'event_type' => $event->type
            ]);

            $webhookEvent = new StripeWebhook($event);
            $this->webhookDispatcher->dispatch($webhookEvent);

        } catch (JsonException $e) {
            $this->logger?->error('Failed to decode JSON data', [
                'exception' => $e->getMessage(),
                'json' => $content
            ]);

            throw new BadRequestHttpException();
        } catch (WebhookSignatureException $e) {
            $this->logger?->error('Failed to handle webhook', [
                'exception' => $e->getMessage(),
                'json' => $content
            ]);

            throw new BadRequestHttpException();
        }

        if ($webhookEvent->hasResponse()) {
            /** @var Response */
            return $webhookEvent->getResponse();
        }

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
