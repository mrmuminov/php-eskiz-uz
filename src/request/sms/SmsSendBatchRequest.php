<?php

namespace mrmuminov\eskizuz\request\sms;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\request\RequestInterface;

/**
 * Class SmsSendBatchRequest
 */
class SmsSendBatchRequest extends AbstractRequest implements RequestInterface
{
    public $action = '/message/sms/send-batch';
    public $responseClass = '\mrmuminov\eskizuz\response\sms\SmsSendBatchResponse';
    private $response;

    public function __construct(ClientInterface $client, array $type, array $headers = [])
    {
        $request = $client->post($this->action, json_encode($type), $headers);
        $this->setResponse(new $this->responseClass($request));
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setResponse($response)
    {
        $this->response = $response;
    }

    public function getResponseClass()
    {
        return $this->responseClass;
    }

    public function setResponseClass($responseClass)
    {
        $this->responseClass = $responseClass;
    }
}
