<?php

namespace mrmuminov\eskizuz\response\sms;

use Exception;
use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\response\AbstractResponse;

/**
 * @author Bahriddin Mo'minov
 *
 * @property SmsGetDispatchStatusDataItemResponse[]|null $data
 */
class SmsGetDispatchStatusResponse extends AbstractResponse
{
    const ESKIS_STATUS_SUCCESS = 'success';

    /**
     * @throws Exception
     */
    public function __construct(
        public ?ClientInterface $client,
        public ?string          $status,
        public ?array           $data,
    )
    {
        if ($client->getStatusCode() === 200 && $client->getResponse()->status === self::ESKIS_STATUS_SUCCESS) {
            $this->status = (string)$client->getResponse()->status;
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
    public function unSerializeData($data): void
    {
        if (is_array($data)) {
            $this->data = [];
            foreach ($data as $i => $item) {
                $this->data[$i] = new SmsGetDispatchStatusDataItemResponse($this->data[$i]);
            }
        }
    }

}