<?php

namespace mrmuminov\eskizuz\response\auth;

use Exception;
use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\response\AbstractResponse;

class AuthUserResponse extends AbstractResponse
{
    public $successMessage = "Success";
    /**@var int $id */
    public $id;
    /**@var string $name */
    public $name;
    /**@var string $email */
    public $email;
    /**@var string $role */
    public $role;
    /**@var string $api_token */
    public $api_token;
    /**@var string $status */
    public $status;
    /**@var string $sms_api_login */
    public $sms_api_login;
    /**@var string $sms_api_password */
    public $sms_api_password;
    /**@var int $uz_price */
    public $uz_price;
    /**@var int $balance */
    public $balance;
    /**@var int $is_vip */
    public $is_vip;
    /**@var string $host */
    public $host;
    /**@var string $created_at */
    public $created_at;
    /**@var string $updated_at */
    public $updated_at;

    /**
     * @throws Exception
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = &$client;
        if ($client->getStatusCode() === 200) {
            $this->message = $this->successMessage;
            $this->isSuccess = true;
            $this->id = $client->getResponse()->id;
            $this->name = $client->getResponse()->name;
            $this->email = $client->getResponse()->email;
            $this->role = $client->getResponse()->role;
            $this->api_token = $client->getResponse()->api_token;
            $this->status = $client->getResponse()->status;
            $this->sms_api_login = $client->getResponse()->sms_api_login;
            $this->sms_api_password = $client->getResponse()->sms_api_password;
            $this->uz_price = $client->getResponse()->uz_price;
            $this->balance = $client->getResponse()->balance;
            $this->is_vip = $client->getResponse()->is_vip;
            $this->host = $client->getResponse()->host;
            $this->created_at = $client->getResponse()->created_at;
            $this->updated_at = $client->getResponse()->updated_at;
        }
    }
}