<?php

namespace mrmuminov\eskizuz\request\sms;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\response\sms\SmsGetDispatchStatusResponse;

/**
 * @author Bahriddin Mo'minov
 * @property SmsGetDispatchStatusResponse $response
 */
class SmsGetDispatchStatusRequest extends AbstractRequest
{
    public string $action = '/message/sms/get-dispatch-status';
    public string $responseClass = SmsGetDispatchStatusResponse::class;

    public function __construct(ClientInterface $client, array $type, array $headers = [])
    {
        $request = $client->post($this->action, $type, $headers);
        $this->setResponse(new $this->responseClass($request));
    }

}
