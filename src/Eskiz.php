<?php

namespace mrmuminov\eskizuz;

use Exception;
use mrmuminov\eskizuz\types\auth\LoginType;
use mrmuminov\eskizuz\types\sms\SingleSmsType;
use mrmuminov\eskizuz\request\sms\SmsSendRequest;
use mrmuminov\eskizuz\request\auth\AuthUserRequest;
use mrmuminov\eskizuz\request\auth\AuthLoginRequest;
use mrmuminov\eskizuz\request\auth\AuthRefreshRequest;
use mrmuminov\eskizuz\request\auth\AuthInvalidateRequest;

/**
 * Class Client
 */
class Eskiz
{
    public $client;
    public $clientClass = '\mrmuminov\eskizuz\client\Client';
    private $baseUrl = 'http://notify.eskiz.uz/api';
    private $email;
    private $password;
    private $token;


    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function requestAuthLogin()
    {
        $type = new LoginType();
        $type->email = $this->email;
        $type->password = $this->password;
        $request = new AuthLoginRequest($this->getClient(), $type->toArray());
        $this->token = $request->getResponse()->token;
        return $request;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getClient()
    {
        if (!$this->client) {
            if (!class_exists($this->clientClass)) {
                throw new Exception('Client class not found');
            }

            $this->client = new $this->clientClass($this->baseUrl);
        }
        return $this->client;
    }

    public function requestAuthInvalidate()
    {
        return new AuthInvalidateRequest($this->getClient(), [], [
            'Authorization' => 'Bearer ' . $this->getToken(),
        ]);
    }

    public function getToken()
    {
        if (!$this->token) {
            throw new Exception('Token not found');
        }
        return $this->token;
    }

    public function requestAuthRefresh()
    {
        return new AuthRefreshRequest($this->getClient(), [], [
            'Authorization' => 'Bearer ' . $this->getToken(),
        ]);
    }

    public function requestAuthUser()
    {
        return new AuthUserRequest($this->getClient(), [], [
            'Authorization' => 'Bearer ' . $this->getToken(),
        ]);
    }

    public function requestSmsSend($from, $message, $mobile_phone, $user_sms_id, $callback_url = null)
    {
        $type = new SingleSmsType();
        $type->from = $from;
        $type->message =$message;
        $type->mobile_phone = $mobile_phone;
        $type->user_sms_id = $user_sms_id;
        $type->callback_url = $callback_url;
        return new SmsSendRequest($this->getClient(), $type->toArray(), [
            'Authorization' => 'Bearer ' . $this->getToken(),
        ]);
    }
}
