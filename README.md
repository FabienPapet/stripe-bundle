# Stripe Bundle for Symfony

## Description

This bundle helps integrating stripe in your Symfony application.

For now it allows you to:

- Handle stripe webhooks as Symfony events

## Next steps

- Redirect users to stripe dashboard
- Add stripe sync into your doctrine models (Customer, etc).
- If needed, integrate symfony messenger for async handling of webhooks

## Installation

`composer require fpt/stripe-bundle`

### Configuration

You can install the bundle by adding a `stripe.yaml` configuration file in your `config/packages` directory. If you
need to use webhooks, you will also need to copy the routing configuration

```yaml
# config/packages/Stripe.yaml
fpt_stripe:
    credentials:
        publishable_key: "%env(STRIPE_PUBLISHABLE_KEY)%"
        secret_key: "%env(STRIPE_SECRET_KEY)%"
        webhook_signature_key: "%env(STRIPE_WEBHOOK_SIGNATURE_KEY)%"
```

### Routing

```yaml
# routes/stripe.yaml
stripe_webhooks:
  resource: "@FptStripeBundle/Resources/config/routes.php"
```

## Usage
