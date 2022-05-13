<?php

namespace mrmuminov\eskizuz\types\auth;

use mrmuminov\eskizuz\types\TypeInterface;

class LoginType implements TypeInterface
{
    public $email;
    public $password;

    public function toArray()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}