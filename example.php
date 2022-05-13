<?php

require 'vendor/autoload.php';

use mrmuminov\eskizuz\Eskiz;


/** First, you need to create a new Eskiz object with email and password. */
$eskiz = new Eskiz("your@email.com", "your-secret-password");

/** First, you need to create a new Eskiz object with email and password. */
$auth = $eskiz->requestAuthLogin();

/** First, you need to create a new Eskiz object with email and password.
 * gateway-number is the number you want to send the SMS to. Default is 4649.
 */
$authUser = $eskiz->requestSmsSend('<gateway-number>', "<your-message>", '<your-phone-number>', '<your-message-identity>', '<your-callback-url>');
