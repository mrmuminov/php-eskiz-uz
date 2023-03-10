<?php

namespace mrmuminov\eskizuz\response\sms;

use Exception;
use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\response\AbstractResponse;

/**
 * @author Bahriddin Mo'minov
 */
class SmsSendResponse extends AbstractResponse
{
    public function __construct(
        public ?ClientInterface $client,
        public ?string           $id,
        public ?int              $status,
        public string           $message,
    )
    {
        $this->message = $client->getResponse()->message;
        if ($client->getStatusCode() === 200) {
            $this->id = (string)$client->getResponse()->id;
            $this->status = $client->getResponse()->status;
            $this->isSuccess = true;
        }
    }

}