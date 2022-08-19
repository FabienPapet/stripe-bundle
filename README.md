[![Version](http://poser.pugx.org/fpt/stripe-bundle/version)](https://packagist.org/packages/fpt/stripe-bundle)
[![PHP Version Require](http://poser.pugx.org/fpt/stripe-bundle/require/php)](https://packagist.org/packages/fpt/stripe-bundle)
![PHPUnit](https://github.com/FabienPapet/stripe-bundle/actions/workflows/unit-tests.yml/badge.svg)
![PHPStan](https://img.shields.io/badge/PHPStan-level%209-brightgreen.svg?style=flat)
![CS](https://github.com/FabienPapet/stripe-bundle/actions/workflows/code_style.yml/badge.svg)
[![License](http://poser.pugx.org/fpt/stripe-bundle/license)](https://packagist.org/packages/fpt/stripe-bundle)
[![Latest Unstable Version](http://poser.pugx.org/fpt/stripe-bundle/v/unstable)](https://packagist.org/packages/fpt/stripe-bundle)

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

- [How to handle stripe webhooks ?](docs/webhooks_as_symfony_events.md)
- [Webhook testing with symfony functional tests](docs/testing_webhooks.md)
- [Twig Function](docs/twig_functions_and_filters.md)

## Support - Contributing

- Feel free to open any issue about a missing feature or if you find a bug in this bundle. 
- Contributions are welcome and encouraged.
