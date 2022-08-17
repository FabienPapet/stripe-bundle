# How to handle stripe webhooks ?

- First you need to enable webhooks in your stripe dashboard
- Then you need to install and configure the bundle with the access_key (begins with `pk_`) and you secret key (begins with `sk_`)
- Then copy you webhook signature key (begins with `whsec_`)

When something happens in your stripe account like a new order, a new invoice, or a new customer, you'll receive an HTTP request on .
Stripe uses webhooks to send the event to your application.


This bundle provides a default route with a default controller imported with this configuration (automatic with Symfony flex)

```yaml
stripe_webhooks:
    resource: "@FptStripeBundle/Resources/config/routes.php"
```

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

    public function onSubscriptionCreated(StripeWebhook $webhook): void
    {
        /** @var \Stripe\Event $stripeEvent */
        $stripeEvent = $webhook->getStripeObject();
        /** @var \Stripe\Subscription $subscriptionStripe */
        $subscriptionStripe = $stripeEvent->data->object;

        // ... Your custom logic here.
    }
}
```

## Webhook signature verification

By default, webhooks are signed by Stripe to secure them and avoid fake events.
You can find the signature secret key into your stripe account. and copy it to your `.env` file.
Signature verification can be disabled with configuration (by example for testing purposes).

```dotenv
# .env
STRIPE_WEBHOOK_SIGNATURE_KEY=paste_your_key_here
```

```yaml
fpt_stripe:
    webhook:
        check_signature: true
        signature_key: "%env(STRIPE_WEBHOOK_SIGNATURE_KEY)%"
```

### Disable signature verification

```yaml
# config/packages/stripe.yaml
fpt_stripe:
    webhook:
        check_signature: false
```

### Disable signature verification in dev/test env

```yaml
# config/packages/stripe.yaml
when@test: # use when@dev for dev
    fpt_stripe:
        webhook:
            check_signature: false
```

