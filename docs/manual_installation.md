# Manual installation 

## Configuration

You can install the bundle by adding a `stripe.yaml` configuration file in your `config/packages` directory. If you
need to use webhooks, you will also need to copy the routing configuration

```yaml
# config/packages/Stripe.yaml
fpt_stripe:
    credentials:
        publishable_key: "%env(STRIPE_PUBLISHABLE_KEY)%"
        secret_key: "%env(STRIPE_SECRET_KEY)%"
    webhook:
        check_signature: true
        signature_key: "%env(STRIPE_WEBHOOK_SIGNATURE_KEY)%"
```

## Routing

```yaml
# routes/stripe.yaml
stripe_webhooks:
  resource: "@FptStripeBundle/Resources/config/routes.php"
```
