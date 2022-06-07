<?php

namespace mrmuminov\eskizuz\request\auth;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\response\auth\AuthUserResponse;

/**
 * Class AuthUserRequest
 */
class AuthUserRequest extends AbstractRequest
{
    public $action = '/auth/user';
    public $responseClass = AuthUserResponse::class;

    public function __construct(ClientInterface $client, array $params = [], array $headers = [])
    {
        $request = $client->get($this->action, $headers);
        $this->setResponse(new $this->responseClass($request));
    }

}
