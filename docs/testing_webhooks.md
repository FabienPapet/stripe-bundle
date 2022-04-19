# Testing webhooks

First make sure signature checks are disabled in your test environment.

```yaml
# config/packages/stripe.yaml
when@test:
    fpt_stripe:
        webhook:
            check_signature: false
```

Then create a class that extends Symfony `WebTestCase`

```php
<?php

namespace App\EventSubscriber;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StripeCustomerCreatedEventTest extends WebTestCase
{
    public function testOnCustomerCreated(): void
    {
        // The webhook content
        $content = <<<EOF
{
  "object": {
    "id": "cus_1KqGE1HsLF5AzybKpCBZxQuZ",
    "object": "customer",
    ...
    },
    "type": "customer.created",
    ...
}
EOF;

        $client = static::createClient();
        $client->request(
            'POST', 
            '/stripe/webhooks', // default url, change it if you don't use it 
            content: $content 
        );

        self::assertResponseStatusCodeSame(204);
        
        // Your custom logic, check if the customer has been created, etc.
    }
}
```
