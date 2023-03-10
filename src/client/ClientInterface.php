<?php

namespace mrmuminov\eskizuz\client;

/**
 * @author Bahriddin Mo'minov
 */
interface ClientInterface
{
    public function __construct(
        string $baseUrl,
        int    $statusCode,
        mixed  $response
    );

    public function request(string $action, array $params, string $method, array $headers = []): ClientInterface;

    public function get(string $action, array $headers = []): ClientInterface;

    public function post(string $action, array $params, array $headers = []): ClientInterface;

    public function patch(string $action, array $params, array $headers = []): ClientInterface;

    public function put(string $action, array $params, array $headers = []): ClientInterface;

    public function delete(string $action, array $params, array $headers = []): ClientInterface;

    public function getStatusCode(): int;

    public function getResponse(): mixed;
}