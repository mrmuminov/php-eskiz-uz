<?php

namespace mrmuminov\eskizuz\response\auth;

use Exception;
use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\response\AbstractResponse;

/**
 * @author Bahriddin Mo'minov
 */
class AuthLoginResponse extends AbstractResponse
{
    public $token;

    /**
     * @throws Exception
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = &$client;
        $this->message = $client->getResponse()->message;
        if ($client->getStatusCode() === 200) {
            $this->token = $client->getResponse()->data->token;
            $this->isSuccess = true;
        }
    }

    public function getToken(): string
    {
        return $this->token;
    }

}