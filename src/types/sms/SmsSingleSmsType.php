<?php

namespace mrmuminov\eskizuz\types\sms;

use InvalidArgumentException;
use mrmuminov\eskizuz\types\TypeInterface;
use mrmuminov\eskizuz\components\NormalizerTrait;

/**
 * @author Bahriddin Mo'minov
 */
class SmsSingleSmsType implements TypeInterface
{
    use NormalizerTrait;

    public function __construct(
        public string $from,
        public string $message,
        public string $mobile_phone,
        public string $user_sms_id,
        public string $callback_url = '',
    )
    {
    }


    public function toArray(): array|bool
    {
        if ($this->validateArguments()) {
            $options = [
                'from' => $this->from,
                'message' => $this->message,
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

    public function validateArguments(): bool
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