<?php

namespace mrmuminov\eskizuz\request\auth;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\response\auth\AuthUserResponse;

/**
 * @author Bahriddin Mo'minov
 *
 * @property AuthUserResponse $response
 */
class AuthUserRequest extends AbstractRequest
{
    public string $action = '/auth/user';
    public string $responseClass = AuthUserResponse::class;

    public function __construct(ClientInterface $client, array $params = [], array $headers = [])
    {
        $request = $client->get($this->action, $headers);
        $this->setResponse(new $this->responseClass($request));
    }

}
