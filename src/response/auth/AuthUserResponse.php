<?php

namespace mrmuminov\eskizuz\response\auth;

use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\response\AbstractResponse;

/**
 * @author Bahriddin Mo'minov
 */
class AuthUserResponse extends AbstractResponse
{
    public function __construct(
        public ?ClientInterface $client,
        public ?int             $id,
        public ?string          $name,
        public ?string          $email,
        public ?string          $role,
        public ?string          $api_token,
        public ?string          $status,
        public ?string          $sms_api_login,
        public ?string          $sms_api_password,
        public ?int             $uz_price,
        public ?int             $balance,
        public ?int             $is_vip,
        public ?string          $host,
        public ?string          $created_at,
        public ?string          $updated_at,
        public string           $message = "Success",
    )
    {
        $this->client = &$client;
        if ($client->getStatusCode() === 200) {
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