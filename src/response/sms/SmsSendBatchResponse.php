<?php

namespace mrmuminov\eskizuz\response\sms;

use Exception;
use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\response\AbstractResponse;

/**
 * @author Bahriddin Mo'minov
 */
class SmsSendBatchResponse extends AbstractResponse
{

    public function __construct(
        public ?ClientInterface $client,
        public ?string           $status,
        public string           $message,
    )
    {
        $this->message = $client->getResponse()->message;
        if ($client->getStatusCode() === 200) {
            $this->status = (string)$client->getResponse()->status;
            $this->isSuccess = true;
        }
    }

}