<?php

namespace mrmuminov\eskizuz\types\auth;

use InvalidArgumentException;
use mrmuminov\eskizuz\types\TypeInterface;

/**
 * @author Bahriddin Mo'minov
 */
class AuthLoginType implements TypeInterface
{
    public string $email;
    public string $password;

    public function toArray(): bool|array
    {
        if ($this->validateArguments()) {
            return [
                'email' => $this->email,
                'password' => $this->password,
            ];
        }
        return false;
    }

    public function validateArguments(): bool
    {
        if (empty($this->email)) {
            throw new InvalidArgumentException('Email is required');
        }
        if (empty($this->password)) {
            throw new InvalidArgumentException('Email is required');
        }
        return true;
    }
}