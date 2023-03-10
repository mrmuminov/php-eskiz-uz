<?php

namespace mrmuminov\eskizuz\request\sms;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\response\sms\SmsSendBatchResponse;

/**
 * @author Bahriddin Mo'minov
 *
 * @property SmsSendBatchResponse $response
 */
class SmsSendBatchRequest extends AbstractRequest
{
    public string $action = '/message/sms/send-batch';
    public string $responseClass = SmsSendBatchResponse::class;

    public function __construct(ClientInterface $client, array $type, array $headers = [])
    {
        $request = $client->post($this->action, json_encode($type), $headers);
        $this->setResponse(new $this->responseClass($request));
    }

}
