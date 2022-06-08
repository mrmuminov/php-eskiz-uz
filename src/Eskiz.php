<?php

namespace mrmuminov\eskizuz;

use Exception;
use RuntimeException;
use mrmuminov\eskizuz\types\auth\LoginType;
use mrmuminov\eskizuz\types\sms\BatchSmsType;
use mrmuminov\eskizuz\types\sms\SingleSmsType;
use mrmuminov\eskizuz\request\sms\SmsSendRequest;
use mrmuminov\eskizuz\request\auth\AuthUserRequest;
use mrmuminov\eskizuz\request\auth\AuthLoginRequest;
use mrmuminov\eskizuz\request\auth\AuthRefreshRequest;
use mrmuminov\eskizuz\request\sms\SmsSendBatchRequest;
use mrmuminov\eskizuz\types\sms\GetDispatchStatusType;
use mrmuminov\eskizuz\request\auth\AuthInvalidateRequest;
use mrmuminov\eskizuz\client\Client;
use mrmuminov\eskizuz\request\sms\SmsGetDispatchStatusRequest;
use mrmuminov\eskizuz\types\sms\GetUserMessagesByDispatchType;
use mrmuminov\eskizuz\request\sms\SmsGetUserMessagesByDispatchRequest;

/**
 * Class Client
 */
class Eskiz
{
    /**
     * СМС в ожидании отправления оператору;
     */
    const STATUS_WAITING = 'Waiting';

    /**
     * СМС передан сотовому оператору, но со стороны оператора обратно не получено статус смс сообщений;
     */
    const STATUS_TRANSMTD = 'TRANSMTD';

    /**
     * доставлено;
     */
    const STATUS_DELIVERED = 'DELIVRD';

    /**
     * недоставлено, обычно причиной может быть то что абонент блокируется со стороны оператора(недостаточно средст или долг);
     */
    const STATUS_UNDELIVERED = 'UNDELIV';

    /**
     * срок жизни смс истек(когда абонент в течение сутки не выходил на связь. У билайн если в теение часа);
     */
    const STATUS_EXPIRED = 'EXPIRED';

    /**
     * один из основных причин это то что номер находится в черном списке;
     */
    const STATUS_REJECTED = 'REJECTD';

    /**
     * ошибка при отправки запроса(например когда адрес отправителя указан неверно);
     */
    const STATUS_DELETED = 'DELETED';


    public $client;
    public $clientClass = Client::class;
    private $baseUrl = 'http://notify.eskiz.uz/api';
    private $email;
    private $password;
    private $token;


    /**
     * @param $email string
     * @param $password string
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @throws Exception
     */
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
                throw new RuntimeException('Client class not found');
            }

            $this->client = new $this->clientClass($this->baseUrl);
        }
        return $this->client;
    }

    /**
     * @return AuthInvalidateRequest
     * @throws Exception
     */
    public function requestAuthInvalidate()
    {
        return new AuthInvalidateRequest($this->getClient(), [], [
            'Authorization' => 'Bearer ' . $this->getToken(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        if (!$this->token) {
            throw new RuntimeException('Token not found');
        }
        return $this->token;
    }

    /**
     * @return AuthRefreshRequest
     * @throws Exception
     */
    public function requestAuthRefresh()
    {
        return new AuthRefreshRequest($this->getClient(), [], [
            'Authorization' => 'Bearer ' . $this->getToken(),
        ]);
    }

    /**
     * @return AuthUserRequest
     * @throws Exception
     */
    public function requestAuthUser()
    {
        return new AuthUserRequest($this->getClient(), [], [
            'Authorization' => 'Bearer ' . $this->getToken(),
        ]);
    }

    /**
     * @param $from int
     * @param $message string
     * @param $mobile_phone int
     * @param $user_sms_id string
     * @param $callback_url string
     * @return SmsSendRequest
     * @throws Exception
     */
    public function requestSmsSend($from, $message, $mobile_phone, $user_sms_id, $callback_url = null)
    {
        $type = new SingleSmsType();
        $type->from = $from;
        $type->message = $message;
        $type->mobile_phone = $mobile_phone;
        $type->user_sms_id = $user_sms_id;
        $type->callback_url = $callback_url;
        return new SmsSendRequest($this->getClient(), $type->toArray(), [
            'Authorization' => 'Bearer ' . $this->getToken(),
        ]);
    }

    /**
     * @param $from numeric
     * @param $messages array{to: int, message: string, id: string}
     * @param $dispatch_id string
     * @param $messageToAll string
     * @return SmsSendBatchRequest
     * @throws Exception
     */
    public function requestSmsSendBatch($from, $messages, $dispatch_id, $messageToAll = null)
    {
        $type = new BatchSmsType();
        $type->from = $from;
        $type->message = $messageToAll;
        $type->messages = $messages;
        $type->dispatch_id = $dispatch_id;
        return new SmsSendBatchRequest($this->getClient(), $type->toArray(), [
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * @param $dispatch_id string
     * @param $user_id string
     * @return SmsGetDispatchStatusRequest
     * @throws Exception
     */
    public function requestGetDispatchStatus($dispatch_id, $user_id = null)
    {
        $type = new GetDispatchStatusType();
        $type->dispatch_id = $dispatch_id;
        $type->user_id = $user_id;
        return new SmsGetDispatchStatusRequest($this->getClient(), $type->toArray(), [
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Content-Type' => 'multipart/form-data',
        ]);
    }

    /**
     * @param $dispatch_id
     * @param $user_id
     * @return SmsGetUserMessagesByDispatchRequest
     * @throws Exception
     */
    public function requestGetUserMessagesByDispatch($dispatch_id, $user_id = null)
    {
        $type = new GetUserMessagesByDispatchType();
        $type->dispatch_id = $dispatch_id;
        $type->user_id = $user_id;
        return new SmsGetUserMessagesByDispatchRequest($this->getClient(), $type->toArray(), [
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Content-Type' => 'multipart/form-data',
        ]);
    }
}
