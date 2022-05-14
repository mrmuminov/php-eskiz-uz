<?php

namespace mrmuminov\eskizuz\client;

/**
 * Interface RequestInterface
 */
interface ClientInterface
{
    public function __construct($baseUrl);

    public function request($action, $params, $method, array $headers = []);

    public function get($action, array $headers = []);

    public function post($action, $params, array $headers = []);

    public function patch($action, $params, array $headers = []);

    public function put($action, $params, array $headers = []);

    public function delete($action, $params, array $headers = []);

    public function getStatusCode();

    public function getResponse();
}