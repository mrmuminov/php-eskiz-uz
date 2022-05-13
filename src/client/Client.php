<?php

namespace mrmuminov\eskizuz\client;

/**
 * Class Client
 */
class Client implements ClientInterface
{
    public $baseUrl;
    public $statusCode;
    public $response;

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function get($action, array $params = [], array $headers = [])
    {
        return $this->request($action, $params, 'GET', $headers);
    }

    public function request($action, array $params, $method, array $headers = [])
    {
        $curl = curl_init();
        $options = [
            CURLOPT_URL => $this->baseUrl . $action,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => array_map(function ($key, $value) {
                return $key . ': ' . $value;
            }, array_keys($headers), $headers),
        ];
        if (in_array($method, ['POST', 'PUT', 'DELETE'])) {
            $options[CURLOPT_POSTFIELDS] = $params;
        }
        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        try {
            $this->response = json_decode($response);
        } catch (\Exception $e) {
            $this->response = $response;
        }
        $this->statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return $this;
    }

    public function post($action, array $params = [], array $headers = [])
    {
        return $this->request($action, $params, 'POST', $headers);
    }

    public function patch($action, array $params = [], array $headers = [])
    {
        return $this->request($action, $params, 'PATCH', $headers);
    }

    public function put($action, array $params = [], array $headers = [])
    {
        return $this->request($action, $params, 'PUT', $headers);
    }

    public function delete($action, array $params = [], array $headers = [])
    {
        return $this->request($action, $params, 'DELETE', $headers);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
