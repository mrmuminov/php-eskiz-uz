<?php

namespace mrmuminov\eskizuz\types\sms;

use mrmuminov\eskizuz\types\TypeInterface;

class SingleSmsType implements TypeInterface
{
    public $from;
    public $message;
    public $mobile_phone;
    public $user_sms_id;
    public $callback_url;

    public function toArray()
    {
        $options = [
            'from' => $this->from,
            'message' => (string)$this->message,
            'user_sms_id' => $this->userSmsIdNormalize($this->user_sms_id),
            'mobile_phone' => $this->phoneNormalise($this->mobile_phone),
            'callback_url' => $this->callback_url,
        ];
        if (empty($options['callback_url'])) {
            unset($options['callback_url']);
        }
        return $options;
    }

    public function phoneNormalise($phoneNumber)
    {
        return preg_replace('/[^\d]/', '', $phoneNumber);
    }

    /**
     * The user sms id may only contain letters and numbers
     */
    public function userSmsIdNormalize($userSmsId)
    {
        return preg_replace('/[^\da-zA-Z]/', '', $userSmsId);
    }
}