# Stripe Bundle for Symfony

## Description

This bundle helps stripe integration in your Symfony application.

For now it allows you to:

- Handle stripe webhooks as Symfony events

## Next steps

- Redirect users to stripe dashboard
- Add stripe sync into your doctrine models (Customer, etc).
- If needed, integrate symfony messenger for async handling of webhooks

## Installation

Installation is automated via Symfony flex, if you don't use flex or want to install manually the bundle, please go to the [Manual installation](./docs/manual_installation.md) section of the documentation.

`composer require fpt/stripe-bundle`

## Documentation

- [Manual installation](docs/manual_installation.md)
- [Webhooks as Symfony Events](docs/webhooks_as_symfony_events.md)
- [Webhook testing with symfony functional tests](docs/testing_webhooks.md)

## Support - Contributing

- Feel free to open any issue about a missing feature or if you find a bug in this bundle. 
- Contributions are welcome and encouraged.
