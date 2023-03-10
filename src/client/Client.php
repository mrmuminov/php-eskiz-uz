<?php

namespace mrmuminov\eskizuz\client;

use Exception;

/**
 * @author Bahriddin Mo'minov
 */
class Client implements ClientInterface
{
    public function __construct(
        public ?string $baseUrl,
        public ?int    $statusCode = null,
        public mixed  $response = null,
    )
    {
    }

    public function delete($action, $params = [], array $headers = []): Client
    {
        return $this->request($action, $params, 'DELETE', $headers);
    }

    public function get($action, array $headers = []): Client
    {
        return $this->request($action, [], 'GET', $headers);
    }

    public function request($action, $params, $method, array $headers = []): Client
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
            CURLOPT_HTTPHEADER => array_map(static function($key, $value) {
                return $key . ': ' . $value;
            }, array_keys($headers), $headers),
        ];
        if (in_array($method, ['POST', 'PUT', 'DELETE'])) {
            $options[CURLOPT_POSTFIELDS] = $params;
        }
        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        try {
            $this->response = json_decode($response, false);
        } catch (Exception $e) {
            $this->response = $response;
        }
        $this->statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return $this;
    }

    public function getResponse(): mixed
    {
        return $this->response;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function patch($action, $params = [], array $headers = []): Client
    {
        return $this->request($action, $params, 'PATCH', $headers);
    }

    public function post($action, $params = [], array $headers = []): Client
    {
        return $this->request($action, $params, 'POST', $headers);
    }

    public function put($action, $params = [], array $headers = []): Client
    {
        return $this->request($action, $params, 'PUT', $headers);
    }
}
