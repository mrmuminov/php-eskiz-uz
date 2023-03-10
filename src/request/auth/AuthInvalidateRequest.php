<?php

namespace mrmuminov\eskizuz\request\auth;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\response\auth\AuthInvalidateResponse;

/**
 * @author Bahriddin Mo'minov
 *
 * @property AuthInvalidateResponse $response
 */
class AuthInvalidateRequest extends AbstractRequest
{
    public string $action = '/auth/invalidate';
    public string $responseClass = AuthInvalidateResponse::class;

    public function __construct(ClientInterface $client, array $params = [], array $headers = [])
    {
        $request = $client->delete($this->action, [], $headers);
        $this->setResponse(new $this->responseClass($request));
    }

}
