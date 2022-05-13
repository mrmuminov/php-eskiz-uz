<?php

namespace mrmuminov\eskizuz\response;

abstract class AbstractResponse
{
    public $client = false;
    public $isSuccess = false;
    public $message = '';
}