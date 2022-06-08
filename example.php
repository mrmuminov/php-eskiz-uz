<?php

require 'vendor/autoload.php';

use mrmuminov\eskizuz\Eskiz;


/**
 * First, you need to create a new Eskiz object with email and password.
 */
$eskiz = new Eskiz("your@email.com", "your-secret-password");

/**
 * First, you need to create a new Eskiz object with email and password.
 */
$auth = $eskiz->requestAuthLogin();

/**
 * First, you need to create a new Eskiz object with email and password.
 * gateway-number is the number you want to send the SMS to. Default is 4649.
 */
$sendSingleSms = $eskiz->requestSmsSend('<gateway-number>', "<your-message>", '<your-phone-number>', '<your-message-identity>', '<your-callback-url>');

/**
 * First, you need to create a new Eskiz object with email and password.
 * gateway-number is the number you want to send the SMS to. Default is 4649.
 * your-message is special message to number.
 * your-message-to-all-numbers is special message to all numbers (if message is empty).
 */
$sendBatchSms = $eskiz->requestSmsSendBatch('<gateway-number>', [
    [
        'id' => '<your-message-identity>',
        'to' => '<your-phone-number>',
        'message' => "<your-message>" // special message to this number
    ],
    [
        'id' => '<your-message-identity>',
        'to' => '<your-phone-number>',
    ],
], "<your-batch-send-identity>",
    "<your-message-to-all-numbers>");

/**
 * First, you need to create a new Eskiz object with email and password.
 * gateway-number is the number you want to send the SMS to. Default is 4649.
 * dispatch-id is batch sms identity.
 * user-id Options, send user id.
 */
$getBatchSmsStatus = $eskiz->requestGetUserMessagesByDispatch('<dispatch-id>', '<user-id>');

/** $firstPageResponse The first page of the response. One page contains 15 messages. */
$firstPageResponse = $getBatchSmsStatus->getResponse();

/** Fetching the next page of the response. */
$getBatchSmsStatus->fetchNextPage();

/** The second page of the response. One page contains 15 messages. */
$secondPageResponse = $getBatchSmsStatus->getResponse();