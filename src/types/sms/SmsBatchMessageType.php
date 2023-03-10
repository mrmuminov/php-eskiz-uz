<?php

namespace mrmuminov\eskizuz\types\sms;

use InvalidArgumentException;
use mrmuminov\eskizuz\types\TypeInterface;
use mrmuminov\eskizuz\components\NormalizerTrait;

/**
 * @author Bahriddin Mo'minov
 */
class SmsBatchMessageType implements TypeInterface
{
    use NormalizerTrait;

    public function __construct(
        public string $to,
        public string $message,
        public string $user_sms_id,
    )
    {
    }


    public function toArray(): array|bool
    {
        if ($this->validateArguments()) {
            return [
                'text' => $this->message,
                'user_sms_id' => $this->userSmsIdNormalize($this->user_sms_id),
                'to' => $this->phoneNormalise($this->to),
            ];
        }
        return false;
    }

    public function validateArguments(): bool
    {
        if (empty($this->to)) {
            throw new InvalidArgumentException("`to` is empty");
        }
        if (empty($this->message)) {
            throw new InvalidArgumentException("`message` is empty");
        }
        if (empty($this->user_sms_id)) {
            throw new InvalidArgumentException("`user_sms_id` is empty");
        }
        return true;
    }
}