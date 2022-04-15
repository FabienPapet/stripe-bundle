# Handle webhooks as symfony events

The default webhook controller handles all webhooks and dispatch the according events

All dispatched events are prefixed with `stripe.` to avoid confusion with other Symfony events that can already exist in your application.


You can use the `Fpt\StripeBundle\Event\StripeEvents` class that contains all events constants for easier reading.

```php
<?php

namespace App\EventSubscriber;

use Fpt\StripeBundle\Event\StripeEvents;
use Fpt\StripeBundle\Event\StripeWebhook;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;

class StripeEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            StripeEvents::CUSTOMER_SUBSCRIPTION_CREATED => 'onSubscriptionCreated',
        ];
    }

    public function onSubscriptionUpdated(StripeWebhook $webhook): void
    {
        /** @var \Stripe\Event $stripeEvent */
        $stripeEvent = $webhook->getStripeObject();
        /** @var \Stripe\Subscription $subscriptionStripe */
        $subscriptionStripe = $stripeEvent->data->object;

        // ... Your custom logic here.
    }
}
```
