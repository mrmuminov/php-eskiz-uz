<?php

namespace mrmuminov\eskizuz\request\sms;

use InvalidArgumentException;
use mrmuminov\eskizuz\client\Client;
use mrmuminov\eskizuz\types\TypeInterface;
use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\request\AbstractRequest;
use mrmuminov\eskizuz\types\sms\SingleSmsType;
use mrmuminov\eskizuz\request\RequestInterface;

/**
 * Class SmsSendRequest
 */
class SmsSendRequest extends AbstractRequest implements RequestInterface
{
    public $action = '/message/sms/send';
    public $responseClass = '\mrmuminov\eskizuz\response\sms\SmsSendResponse';
    private $response;

    public function __construct(ClientInterface $client, array $type, array $headers = [])
    {
        $request = $client->post($this->action, $type, $headers);
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
