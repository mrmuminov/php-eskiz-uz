<?php

namespace mrmuminov\eskizuz\request\sms;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\response\sms\SmsSendResponse;

/**
 * @author Bahriddin Mo'minov
 *
 * @property SmsSendResponse $response
 */
class SmsSendRequest extends AbstractRequest
{
    public string $action = '/message/sms/send';
    public string $responseClass = SmsSendResponse::class;

    public function __construct(ClientInterface $client, array $type, array $headers = [])
    {
        $client->post($this->action, $type, $headers);
        $this->setResponse(new $this->responseClass($client));
    }

}
