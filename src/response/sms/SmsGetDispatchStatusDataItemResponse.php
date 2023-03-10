<?php

namespace mrmuminov\eskizuz\response\sms;

use Exception;

/**
 * @author Bahriddin Mo'minov
 */
class SmsGetDispatchStatusDataItemResponse
{
    /**
     * @throws Exception
     */
    public function __construct(
        public ?string $total,
        public ?string $status,
    )
    {
    }

}