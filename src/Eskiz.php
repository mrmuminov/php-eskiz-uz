<?php

namespace mrmuminov\eskizuz;

use Exception;
use RuntimeException;
use mrmuminov\eskizuz\client\Client;
use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\types\auth\AuthLoginType;
use mrmuminov\eskizuz\types\sms\SmsBatchSmsType;
use mrmuminov\eskizuz\types\sms\SmsSingleSmsType;
use mrmuminov\eskizuz\request\sms\SmsSendRequest;
use mrmuminov\eskizuz\request\auth\AuthUserRequest;
use mrmuminov\eskizuz\request\auth\AuthLoginRequest;
use mrmuminov\eskizuz\request\auth\AuthRefreshRequest;
use mrmuminov\eskizuz\request\sms\SmsSendBatchRequest;
use mrmuminov\eskizuz\types\sms\SmsGetDispatchStatusType;
use mrmuminov\eskizuz\request\auth\AuthInvalidateRequest;
use mrmuminov\eskizuz\request\sms\SmsGetDispatchStatusRequest;
use mrmuminov\eskizuz\types\sms\SmsGetUserMessagesByDispatchType;
use mrmuminov\eskizuz\request\sms\SmsGetUserMessagesByDispatchRequest;

/**
 * @author Bahriddin Mo'minov
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


    public ?ClientInterface $client;
    public string $clientClass = Client::class;
    private string $baseUrl = 'http://notify.eskiz.uz/api';
    private string $email;
    private string $password;
    private string $token;

    public function __construct(string $email, string $password)
    {
        if (!class_exists($this->clientClass)) {
            throw new RuntimeException('Client class not found');
        }
        $this->client = new $this->clientClass(
            baseUrl: $this->baseUrl,
        );
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @throws Exception
     */
    public function requestAuthLogin(): AuthLoginRequest
    {
        $type = new AuthLoginType();
        $type->email = $this->email;
        $type->password = $this->password;
        $request = new AuthLoginRequest($this->getClient(), $type->toArray());
        if (empty($request->getResponse()->token)) {
            throw new Exception($request->getResponse()->message, 5);
        }
        $this->token = $request->getResponse()->token;
        return $request;
    }

    public function getClient(): ClientInterface
    {
        if (!$this->client) {
            if (!class_exists($this->clientClass)) {
                throw new RuntimeException('Client class not found');
            }

            $this->client = new $this->clientClass($this->baseUrl);
        }
        return $this->client;
    }

    public function requestAuthInvalidate(): AuthInvalidateRequest
    {
        return new AuthInvalidateRequest($this->getClient(), [], [
            'Authorization' => 'Bearer ' . $this->getToken(),
        ]);
    }

    public function getToken(): string
    {
        if (!$this->token) {
            throw new RuntimeException('Token not found');
        }
        return $this->token;
    }

    public function requestAuthRefresh(): AuthRefreshRequest
    {
        return new AuthRefreshRequest($this->getClient(), [], [
            'Authorization' => 'Bearer ' . $this->getToken(),
        ]);
    }

    public function requestAuthUser(): AuthUserRequest
    {
        return new AuthUserRequest($this->getClient(), [], [
            'Authorization' => 'Bearer ' . $this->getToken(),
        ]);
    }


    public function requestSmsSend(SmsSingleSmsType $type): SmsSendRequest
    {
        return new SmsSendRequest($this->getClient(), $type->toArray(), [
            'Authorization' => 'Bearer ' . $this->getToken(),
        ]);
    }

    public function requestSmsSendBatch(SmsBatchSmsType $type): SmsSendBatchRequest
    {
        return new SmsSendBatchRequest($this->getClient(), $type->toArray(), [
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Content-Type' => 'application/json',
        ]);
    }

    public function requestGetDispatchStatus(SmsGetDispatchStatusType $type): SmsGetDispatchStatusRequest
    {
        return new SmsGetDispatchStatusRequest($this->getClient(), $type->toArray(), [
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Content-Type' => 'multipart/form-data',
        ]);
    }

    public function requestGetUserMessagesByDispatch(SmsGetUserMessagesByDispatchType $type): SmsGetUserMessagesByDispatchRequest
    {
        return new SmsGetUserMessagesByDispatchRequest($this->getClient(), $type->toArray(), [
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Content-Type' => 'multipart/form-data',
        ]);
    }
}
