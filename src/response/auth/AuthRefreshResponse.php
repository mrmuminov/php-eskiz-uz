<?php

namespace mrmuminov\eskizuz\response\auth;

use Exception;
use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\response\AbstractResponse;

/**
 * @author Bahriddin Mo'minov
 */
class AuthRefreshResponse extends AbstractResponse
{
    /**
     * @throws Exception
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = &$client;
        $this->message = $client->getResponse()->message;
        if ($client->getStatusCode() === 200) {
            $this->isSuccess = true;
        }
    }
}