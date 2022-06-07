<?php

namespace mrmuminov\eskizuz\request;

/**
 * Class AbstractClient
 */
abstract class AbstractRequest implements RequestInterface
{
    public $action = '';
    public $responseClass = '';
    protected $response;

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
