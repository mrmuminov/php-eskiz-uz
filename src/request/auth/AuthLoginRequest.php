<?php

namespace mrmuminov\eskizuz\request\auth;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\request\RequestInterface;

/**
 * Class AuthLoginClient
 */
class AuthLoginRequest extends AbstractRequest implements RequestInterface
{
    public $action = '/auth/login';
    public $responseClass = '\mrmuminov\eskizuz\response\auth\AuthLoginResponse';

    public function __construct(ClientInterface $client, array $type, array $headers = [])
    {
        $request = $client->post($this->action, $type, $headers);
        $this->setResponse(new $this->responseClass($request));
    }

}
