<?php

namespace mrmuminov\eskizuz\response\sms;

class SmsGetUserMessagesByDispatchDataItemResponse
{
    public $id;
    public $user_id;
    public $dispatch_id;
    public $jasmin_id;
    public $user_sms_id;
    public $country_code;
    public $operator;
    public $nickname;
    public $to;
    public $content;
    public $packets;
    public $is_balanced;
    public $callback_url;
    public $status;
    public $status_date;
    public $created_at;
    public $updated_at;

    public function __construct($data)
    {
        $this->id = $data->id;
        $this->user_id = $data->user_id;
        $this->dispatch_id = $data->dispatch_id;
        $this->jasmin_id = $data->jasmin_id;
        $this->user_sms_id = $data->user_sms_id;
        $this->country_code = $data->country_code;
        $this->operator = $data->operator;
        $this->nickname = $data->nickname;
        $this->to = $data->to;
        $this->content = $data->content;
        $this->packets = $data->packets;
        $this->is_balanced = $data->is_balanced;
        $this->callback_url = $data->callback_url;
        $this->status = $data->status;
        $this->status_date = $data->status_date;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
    }
}