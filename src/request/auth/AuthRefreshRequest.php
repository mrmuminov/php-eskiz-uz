<?php

namespace mrmuminov\eskizuz\request\auth;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\response\auth\AuthRefreshResponse;

/**
 * @author Bahriddin Mo'minov
 *
 * @property AuthRefreshResponse $response
 */
class AuthRefreshRequest extends AbstractRequest
{
    public string $action = '/auth/refresh';
    public string $responseClass = AuthRefreshResponse::class;

    public function __construct(ClientInterface $client, array $params = [], array $headers = [])
    {
        $request = $client->patch($this->action, [], $headers);
        $this->setResponse(new $this->responseClass($request));
    }

}
