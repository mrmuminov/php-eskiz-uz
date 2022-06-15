<?php

namespace mrmuminov\eskizuz\types\sms;

use InvalidArgumentException;
use mrmuminov\eskizuz\types\TypeInterface;

class BatchSmsType implements TypeInterface
{

    public $from;
    public $message;
    public $messages;
    public $dispatch_id;

    public function toArray()
    {
        if ($this->validateArguments()) {
            $messages = [];
            foreach ($this->messages as $message) {
                $singleSmsType = new BatchMessageType();
                $singleSmsType->to = $message['to'];
                $singleSmsType->message = isset($message['message']) ? $message['message'] : $this->message;
                $singleSmsType->user_sms_id = $message['id'];
                $messages[] = $singleSmsType->toArray();
            }
            return [
                'from' => $this->from,
                'messages' => $messages,
                'dispatch_id' => $this->dispatch_id,
            ];
        }
        return false;
    }

    public function validateArguments()
    {
        if (empty($this->from)) {
            throw new InvalidArgumentException("`from` is empty");
        }
        if (empty($this->messages)) {
            throw new InvalidArgumentException("`messages` is empty");
        }
        if (empty($this->dispatch_id)) {
            throw new InvalidArgumentException("`dispatch_id` is empty");
        }
        return true;
    }
}