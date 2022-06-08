<?php

namespace mrmuminov\eskizuz\request\sms;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\response\sms\SmsGetDispatchStatusResponse;

/**
 * Class SmsGetDispatchStatusRequest
 *
 * @property SmsGetDispatchStatusResponse $response
 */
class SmsGetDispatchStatusRequest extends AbstractRequest
{
    public $action = '/message/sms/get-dispatch-status';
    public $responseClass = SmsGetDispatchStatusResponse::class;

    public function __construct(ClientInterface $client, array $type, array $headers = [])
    {
        $request = $client->post($this->action, $type, $headers);
        $this->setResponse(new $this->responseClass($request));
    }

}
