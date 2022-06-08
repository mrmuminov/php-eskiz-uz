<?php

namespace mrmuminov\eskizuz\response\sms;

use Exception;
use mrmuminov\eskizuz\client\ClientInterface;
use mrmuminov\eskizuz\response\AbstractResponse;

/**
 * Class SmsGetUserMessagesByDispatchResponse
 *
 * @var string $status
 * @var int $current_page
 * @var SmsGetUserMessagesByDispatchDataItemResponse[] $data
 * @var string $first_page_url
 * @var string $from
 * @var int $last_page
 * @var string $last_page_url
 * @var SmsGetUserMessagesByDispatchLinksResponse[] $links
 * @var string $next_page_url
 * @var string $path
 * @var int $per_page
 * @var string $prev_page_url
 * @var int $to
 * @var int $total
 */
class SmsGetUserMessagesByDispatchResponse extends AbstractResponse
{
    public $status;
    public $current_page;
    public $data;
    public $first_page_url;
    public $from;
    public $last_page;
    public $last_page_url;
    public $links;
    public $next_page_url;
    public $path;
    public $per_page;
    public $prev_page_url;
    public $to;
    public $total;

    /**
     * @throws Exception
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
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

    /**
     * @param $message
     * @return void
     */
    public function clear($message = '')
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

    /**
     * @param $data
     * @return void
     * @throws Exception
     */
    public function unSerializeData($data)
    {
        if (is_array($data)) {
            $this->data = [];
            foreach ($data as $i => $item) {
                $this->data[$i] = new SmsGetUserMessagesByDispatchDataItemResponse($item);
            }
        }
    }

    private function unSerializeLinks($data)
    {
        if (is_array($data)) {
            $this->links = [];
            foreach ($data as $i => $item) {
                $this->links[$i] = new SmsGetUserMessagesByDispatchLinksResponse($item);
            }
        }
    }
}