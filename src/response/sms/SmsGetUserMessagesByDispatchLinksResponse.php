<?php

namespace mrmuminov\eskizuz\response\sms;

/**
 * @author Bahriddin Mo'minov
 */
class SmsGetUserMessagesByDispatchLinksResponse
{

    public function __construct(
        public ?string $url,
        public ?string $label,
        public bool   $active = false,
    )
    {
    }
}