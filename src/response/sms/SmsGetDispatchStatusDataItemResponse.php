<?php

namespace mrmuminov\eskizuz\response\sms;

use Exception;

class SmsGetDispatchStatusDataItemResponse
{
    public $total;
    public $status;

    /**
     * @throws Exception
     */
    public function __construct($data)
    {
        $this->total = $data->total;
        $this->status = $data->status;
    }

}