<?php

namespace mrmuminov\eskizuz\request;

/**
 * @author Bahriddin Mo'minov
 */
abstract class AbstractRequest implements RequestInterface
{
    public string $action = '';
    public string $responseClass = '';
    protected mixed $response;

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function getResponse(): mixed
    {
        return $this->response;
    }

    public function setResponse(mixed $response): void
    {
        $this->response = $response;
    }

    public function getResponseClass(): string
    {
        return $this->responseClass;
    }

    public function setResponseClass(string $responseClass): void
    {
        $this->responseClass = $responseClass;
    }
}
