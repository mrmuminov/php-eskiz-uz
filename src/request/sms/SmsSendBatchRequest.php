<?php

namespace mrmuminov\eskizuz\request\sms;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\response\sms\SmsSendBatchResponse;

/**
 * Class SmsSendBatchRequest
 *
 * @property SmsSendBatchResponse $response
 */
class SmsSendBatchRequest extends AbstractRequest
{
    public $action = '/message/sms/send-batch';
    public $responseClass = SmsSendBatchResponse::class;

    public function __construct(ClientInterface $client, array $type, array $headers = [])
    {
        $request = $client->post($this->action, json_encode($type), $headers);
        $this->setResponse(new $this->responseClass($request));
    }

}
