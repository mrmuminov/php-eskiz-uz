<?php

namespace mrmuminov\eskizuz\request;

use mrmuminov\eskizuz\client\ClientInterface;

/**
 * @author Bahriddin Mo'minov
 */
interface RequestInterface
{
    public function __construct(ClientInterface $client, array $params, array $headers = []);

    public function getAction(): string;

    public function setAction(string $action): void;

    public function getResponse(): mixed;

    public function setResponse(mixed $response): void;

    public function getResponseClass(): string;

    public function setResponseClass(string $responseClass): void;
}