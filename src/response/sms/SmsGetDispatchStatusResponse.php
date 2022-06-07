<?php

namespace mrmuminov\eskizuz\response\sms;

use Exception;
use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\response\AbstractResponse;

class SmsGetDispatchStatusResponse extends AbstractResponse
{
    const ESKIS_STATUS_SUCCESS = 'success';

    /**
     * @var string
     */
    public $status;

    /**
     * @var SmsGetDispatchStatusDataItemResponse[]|null
     */
    public $data;

    /**
     * @throws Exception
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        if ($client->getStatusCode() === 200 && $client->getResponse()->status === self::ESKIS_STATUS_SUCCESS) {
            $this->status = $client->getResponse()->status;
            $this->unSerializeData($client->getResponse()->data);
            $this->isSuccess = true;
        } else {
            $this->isSuccess = false;
        }
    }

    /**
     * @param $data
     * @return void
     * @throws Exception
     */
    public function unSerializeData($data)
    {
        if (is_array($data)) {
            $this->data = [];
            foreach ($data as $i => $iValue) {
                $this->data[$i] = new SmsGetDispatchStatusDataItemResponse($this->data[$i]);
            }
        }
    }

}