PHP Eskiz.uz
============

PHP Eskiz.uz SMS Gateway package

## Installation

```bash
composer require mrmuminov/php-eskiz-uz
```

or add the following to your `composer.json` file:

```json
{
    "require": {
        "mrmuminov/php-eskiz-uz": "^1.0.0"
    }
}
```

## Usage

---

```php
<?php

require 'vendor/autoload.php';

use mrmuminov\eskizuz\Eskiz;
```

---

-

First, you need to create a new Eskiz object with email and password.

```php
$eskiz = new Eskiz("your@email.com", "your-secret-password");
```

---

First, you need to create a new Eskiz object with email and password.

```php
$auth = $eskiz->requestAuthLogin();
```

---

First, you need to create a new Eskiz object with email and password. \
`gateway-number` is the number you want to send the SMS to. Default is 4649.\
`your-message` is special message to number.\
`your-phone-number` is phone number.\
`your-message-identity` is special identity to message.\
`your-callback-url` is url for call status return url.

```php
$sendSingleSms = $eskiz->requestSmsSend(
    '<gateway-number>', 
    '<your-message>', 
    '<your-phone-number>', 
    '<your-message-identity>', 
    '<your-callback-url>'
);
```

---

First, you need to create a new Eskiz object with email and password.\
`gateway-number` is the number you want to send the SMS to. Default is 4649.\
`your-message` is special message to number.\
`your-phone-number` is phone number.\
`your-message-identity` is special identity to message.\
`your-batch-send-identity` is special identity to batch-send.\
`your-message-to-all-numbers` is special message to all numbers (if message is empty).

```php
$sendBatchSms = $eskiz->requestSmsSendBatch('<gateway-number>', [
    [
        'id' => '<your-message-identity>',
        'to' => '<your-phone-number>',
        'message' => '<your-message>' // (optional) special message to this number
    ],
    [
        'id' => '<your-message-identity>',
        'to' => '<your-phone-number>',
    ],
], '<your-batch-send-identity>',
    '<your-message-to-all-numbers>');
```
