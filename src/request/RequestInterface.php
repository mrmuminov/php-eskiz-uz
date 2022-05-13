<?php

namespace mrmuminov\eskizuz\request;

use mrmuminov\eskizuz\client\ClientInterface;

/**
 * Interface RequestInterface
 */
interface RequestInterface
{
    public function __construct(ClientInterface $client, array $params, array $headers = []);

    public function getAction();

    public function setAction($action);

    public function getResponse();

    public function setResponse($response);

    public function getResponseClass();

    public function setResponseClass($responseClass);
}