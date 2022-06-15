<?php

namespace mrmuminov\eskizuz\types\sms;

use InvalidArgumentException;
use mrmuminov\eskizuz\types\TypeInterface;
use mrmuminov\eskizuz\components\NormalizerTrait;

class SingleSmsType implements TypeInterface
{
    use NormalizerTrait;

    public $from;
    public $message;
    public $mobile_phone;
    public $user_sms_id;
    public $callback_url;

    public function toArray()
    {
        if ($this->validateArguments()) {
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
        return false;
    }

    /**
     * @return bool
     */
    public function validateArguments()
    {
        if (empty($this->from)) {
            throw new InvalidArgumentException("`from` is empty");
        }
        if (empty($this->message)) {
            throw new InvalidArgumentException("`message` is empty");
        }
        if (empty($this->user_sms_id)) {
            throw new InvalidArgumentException("`user_sms_id` is empty");
        }
        if (empty($this->mobile_phone)) {
            throw new InvalidArgumentException("`mobile_phone` is empty");
        }
        return true;
    }
}