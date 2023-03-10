<?php

namespace mrmuminov\eskizuz\types\sms;

use InvalidArgumentException;
use mrmuminov\eskizuz\types\TypeInterface;

/**
 * @author Bahriddin Mo'minov
 */
class SmsGetDispatchStatusType implements TypeInterface
{
    public function __construct(
        public string $dispatch_id,
        public string $user_id,
    )
    {
    }


    public function toArray(): array|bool
    {
        if ($this->validateArguments()) {
            $options = [
                'dispatch_id' => $this->dispatch_id,
            ];
            if ($this->user_id) {
                $options['user_id'] = $this->user_id;
            }
            return $options;
        }
        return false;
    }

    public function validateArguments(): bool
    {
        if (empty($this->dispatch_id)) {
            throw new InvalidArgumentException("`dispatch_id` is empty");
        }
        return true;
    }
}