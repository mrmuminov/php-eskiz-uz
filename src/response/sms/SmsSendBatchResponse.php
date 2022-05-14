<?php

namespace mrmuminov\eskizuz\response\sms;

use Exception;
use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\response\AbstractResponse;

class SmsSendBatchResponse extends AbstractResponse
{
    public $id;
    public $status;
    public $message;


    /**
     * @throws Exception
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        $this->message = $client->getResponse()->message;
        if ($client->getStatusCode() === 200) {
            $this->status = $client->getResponse()->status;
            $this->isSuccess = true;
        }
    }

}