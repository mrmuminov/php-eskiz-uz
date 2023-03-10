<?php

namespace mrmuminov\eskizuz\response\sms;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\response\AbstractResponse;

/**
 * @author Bahriddin Mo'minov
 */
class SmsSendBatchResponse extends AbstractResponse
{
    public ?string $status;
    public string $message;

    public function __construct(
        public ?ClientInterface $client,
    )
    {
        $this->message = $client->getResponse()->message;
        if ($client->getStatusCode() === 200) {
            $this->status = (string)$client->getResponse()->status;
            $this->isSuccess = true;
        }
    }

}