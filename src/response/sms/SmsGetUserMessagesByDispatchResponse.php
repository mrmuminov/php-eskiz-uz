<?php

namespace mrmuminov\eskizuz\response\sms;

use Exception;
use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\response\AbstractResponse;

/**
 * @author Bahriddin Mo'minov
 *
 * @property string $status
 * @property int $current_page
 * @property SmsGetUserMessagesByDispatchDataItemResponse[] $data
 * @property string $first_page_url
 * @property string $from
 * @property int $last_page
 * @property string $last_page_url
 * @property SmsGetUserMessagesByDispatchLinksResponse[] $links
 * @property string $next_page_url
 * @property string $path
 * @property int $per_page
 * @property string $prev_page_url
 * @property int $to
 * @property int $total
 */
class SmsGetUserMessagesByDispatchResponse extends AbstractResponse
{
    public ?string $status;
    public ?int $current_page;
    public ?array $data;
    public ?string $first_page_url;
    public ?string $from;
    public ?int $last_page;
    public ?string $last_page_url;
    public ?array $links;
    public ?string $next_page_url;
    public ?string $path;
    public ?int $per_page;
    public ?string $prev_page_url;
    public ?int $to;
    public ?int $total;

    /**
     * @throws Exception
     */
    public function __construct(
        public ?ClientInterface $client,
    )
    {
        if ($client->getStatusCode() === 200) {
            $this->isSuccess = true;
            $data = $client->getResponse()->data;
            $this->current_page = $data->current_page;
            $this->unSerializeData($data->data);
            $this->first_page_url = $data->first_page_url;
            $this->from = $data->from;
            $this->last_page = $data->last_page;
            $this->last_page_url = $data->last_page_url;
            $this->unSerializeLinks($data->links);
            $this->next_page_url = $data->next_page_url;
            $this->path = $data->path;
            $this->per_page = $data->per_page;
            $this->prev_page_url = $data->prev_page_url;
            $this->to = $data->to;
            $this->total = $data->total;
        } else {
            $this->isSuccess = false;
            $this->status = $client->getResponse()->status;
            $this->message = "";
            foreach ($client->getResponse()->message as $messages) {
                $this->message .= implode("\n", $messages) . "\n";
            }
        }
    }

    public function unSerializeData(array $data): void
    {
        $this->data = [];
        foreach ($data as $i => $item) {
            $this->data[$i] = new SmsGetUserMessagesByDispatchDataItemResponse(
                id: $item?->id ?? '',
                user_id: $item?->user_id ?? '',
                dispatch_id: $item?->dispatch_id ?? '',
                jasmin_id: $item?->jasmin_id ?? '',
                user_sms_id: $item?->user_sms_id ?? '',
                price: $item?->price ?? '',
                country_code: $item?->country_code ?? '',
                operator: $item?->operator ?? '',
                nickname: $item?->nickname ?? '',
                to: $item?->to ?? '',
                content: $item?->content ?? '',
                packets: $item?->packets ?? '',
                msg_type: $item?->msg_type ?? '',
                is_balanced: $item?->is_balanced ?? '',
                callback_url: $item?->callback_url ?? '',
                status: $item?->status ?? '',
                status_date: $item?->status_date ?? '',
                created_at: $item?->created_at ?? '',
                updated_at: $item?->updated_at ?? '',
            );
        }
    }

    private function unSerializeLinks(array $data): void
    {
        $this->links = [];
        foreach ($data as $i => $item) {
            $this->links[$i] = new SmsGetUserMessagesByDispatchLinksResponse(
                url: $item?->url ?? '',
                label: $item?->label ?? '',
                active: $item?->active ?? false,
            );
        }
    }

    public function clear(string $message = ''): void
    {
        $this->isSuccess = false;
        $this->current_page = null;
        $this->data = [];
        $this->first_page_url = null;
        $this->from = null;
        $this->last_page = null;
        $this->last_page_url = null;
        $this->links = [];
        $this->next_page_url = null;
        $this->path = null;
        $this->per_page = null;
        $this->prev_page_url = null;
        $this->to = null;
        $this->total = null;
        $this->message = $message;
    }
}