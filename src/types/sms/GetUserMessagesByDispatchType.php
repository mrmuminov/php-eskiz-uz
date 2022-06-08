<?php

namespace mrmuminov\eskizuz\types\sms;

use InvalidArgumentException;
use mrmuminov\eskizuz\types\TypeInterface;

class GetUserMessagesByDispatchType implements TypeInterface
{
    public $dispatch_id;
    public $user_id;

    public function toArray()
    {
        if ($this->validateArguments()) {
            $options = [
                'dispatch_id' => (string)$this->dispatch_id
            ];
            if ($this->user_id) {
                $options['user_id'] = (string)$this->user_id;
            }
            return $options;
        }
        return false;
    }

    public function validateArguments()
    {
        if (empty($this->dispatch_id)) {
            throw new InvalidArgumentException("`dispatch_id` is empty");
        }
        return true;
    }
}