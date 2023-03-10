<?php

namespace mrmuminov\eskizuz\response;

use mrmuminov\eskizuz\client\ClientInterface;

/**
 * @author Bahriddin Mo'minov
 */
abstract class AbstractResponse implements ResponseInterface
{
    public ?ClientInterface $client = null;
    public bool $isSuccess = false;
    public string $message = '';
}