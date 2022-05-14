<?php

namespace mrmuminov\eskizuz\types\auth;

use InvalidArgumentException;
use mrmuminov\eskizuz\types\TypeInterface;

class LoginType implements TypeInterface
{
    public $email;
    public $password;

    public function toArray()
    {
        if ($this->validateArguments()) {
            return [
                'email' => $this->email,
                'password' => $this->password,
            ];
        }
        return false;
    }

    public function validateArguments()
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