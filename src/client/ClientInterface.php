<?php

namespace mrmuminov\eskizuz\client;

/**
 * Interface RequestInterface
 */
interface ClientInterface
{
    public function __construct($baseUrl);

    public function request($action, array $params, $method, array $headers = []);

    public function get($action, array $params, array $headers = []);

    public function post($action, array $params, array $headers = []);

    public function patch($action, array $params, array $headers = []);

    public function put($action, array $params, array $headers = []);

    public function delete($action, array $params, array $headers = []);

    public function getStatusCode();

    public function getResponse();
}