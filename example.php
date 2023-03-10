<?php

require 'vendor/autoload.php';

use mrmuminov\eskizuz\Eskiz;
use mrmuminov\eskizuz\types\sms\SmsBatchSmsType;
use mrmuminov\eskizuz\types\sms\SmsSingleSmsType;
use mrmuminov\eskizuz\types\sms\SmsBatchMessageType;
use mrmuminov\eskizuz\types\sms\SmsGetUserMessagesByDispatchType;


/**
 * First, you need to create a new Eskiz object with email and password.
 * @version 2.0.0
 */
$eskiz = new Eskiz("your@email.com", "your-secret-password");

/**
 * Declare variables
 */
$from = '<gateway-number>';
$message = '<your-message>';
$mobile_phone = '<your-phone-number>';
$user_sms_id = '<your-message-identity>';
$callback_url = '<your-callback-url>';
$dispatch_id = '<your-batch-send-identity>';
$user_id = '<user-id>';

/**
 * First, you need to create a new Eskiz object with email and password.
 */
$auth = $eskiz->requestAuthLogin();

/**
 * First, you need to create a new Eskiz object with email and password.
 * gateway-number is the number you want to send the SMS to. Default is 4649.
 */
$singleSmsType = new SmsSingleSmsType(
    from: $from,
    message: $message,
    mobile_phone: $mobile_phone,
    user_sms_id: $user_sms_id,
    callback_url: $callback_url,
);
$sendSingleSms = $eskiz->requestSmsSend($singleSmsType);

/**
 * First, you need to create a new Eskiz object with email and password.
 * gateway-number is the number you want to send the SMS to. Default is 4649.
 * your-message is special message to number.
 * your-message-to-all-numbers is special message to all numbers (if message is empty).
 */
$batchSmsType = new SmsBatchSmsType(
    from: $from,
    messages: [
        new SmsBatchMessageType(
            to: $mobile_phone,
            message: $message,
            user_sms_id: $user_sms_id,
        ),
    ],
    dispatch_id: $dispatch_id
);
$sendBatchSms = $eskiz->requestSmsSendBatch($batchSmsType);

/**
 * First, you need to create a new Eskiz object with email and password.
 * gateway-number is the number you want to send the SMS to. Default is 4649.
 * dispatch-id is batch sms identity.
 * user-id Options, send user id.
 */
$getUserMessagesByDispatchType = new SmsGetUserMessagesByDispatchType(
    dispatch_id: $dispatch_id,
    user_id: $user_id,
);
$getBatchSmsStatus = $eskiz->requestGetUserMessagesByDispatch($getUserMessagesByDispatchType);

/** $firstPageResponse The first page of the response. One page contains 15 messages. */
$firstPageResponse = $getBatchSmsStatus->getResponse();

/** Fetching the next page of the response. */
$getBatchSmsStatus->fetchNextPage();

/** The second page of the response. One page contains 15 messages. */
$secondPageResponse = $getBatchSmsStatus->getResponse();