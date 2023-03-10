<?php

namespace mrmuminov\eskizuz\response\sms;

/**
 * @author Bahriddin Mo'minov
 */
class SmsGetUserMessagesByDispatchDataItemResponse
{
    public function __construct(
        public ?string $id,
        public ?string $user_id,
        public ?string $dispatch_id,
        public ?string $jasmin_id,
        public ?string $user_sms_id,
        public ?string $price,
        public ?string $country_code,
        public ?string $operator,
        public ?string $nickname,
        public ?string $to,
        public ?string $content,
        public ?string $packets,
        public ?string $msg_type,
        public ?string $is_balanced,
        public ?string $callback_url,
        public ?string $status,
        public ?string $status_date,
        public ?string $created_at,
        public ?string $updated_at,
    )
    {
    }
}