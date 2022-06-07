<?php

namespace mrmuminov\eskizuz\request\auth;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\response\auth\AuthRefreshResponse;

/**
 * Class AuthRefreshClient
 */
class AuthRefreshRequest extends AbstractRequest
{
    public $action = '/auth/refresh';
    public $responseClass = AuthRefreshResponse::class;

    public function __construct(ClientInterface $client, array $params = [], array $headers = [])
    {
        $request = $client->patch($this->action, [], $headers);
        $this->setResponse(new $this->responseClass($request));
    }

}
