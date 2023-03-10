<?php

namespace mrmuminov\eskizuz\types\sms;

use InvalidArgumentException;
use mrmuminov\eskizuz\types\TypeInterface;

/**
 * @author Bahriddin Mo'minov
 */
class SmsBatchSmsType implements TypeInterface
{
    public function __construct(
        public string $from,
        /**@var SmsBatchMessageType[] $messages */
        public array  $messages,
        public string $dispatch_id,
    )
    {
    }


    public function toArray(): array|bool
    {
        if ($this->validateArguments()) {
            $messages = [];
            foreach ($this->messages as $message) {
                /**@var SmsBatchMessageType $message */
                $messages[] = $message->toArray();
            }
            return [
                'from' => $this->from,
                'messages' => $messages,
                'dispatch_id' => $this->dispatch_id,
            ];
        }
        return false;
    }

    public function validateArguments(): bool
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