<?php

namespace mrmuminov\eskizuz\response\sms;

class SmsGetUserMessagesByDispatchLinksResponse
{
    public $url;
    public $label;
    public $active = false;

    public function __construct($data)
    {
        $this->url = $data->url;
        $this->label = $data->label;
        $this->active = $data->active;
    }
}