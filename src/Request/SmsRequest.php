<?php

namespace Ibtdi\HiSms\Request;

use Ibtdi\HiSms\Request\Components\Message;
use Ibtdi\HiSms\Request\Components\Receiver;

/**
 * Class SmsRequest
 */
class SmsRequest extends BaseRequest
{

    /**
     * @var Receiver
     */
    private $receiver;
    /**
     * @var Message
     */
    private $message;

    /**
     * @param  Receiver  $receiver
     * @param  Message  $message
     */
    public function __construct(Receiver $receiver, Message $message)
    {
        parent::__construct();
        $this->receiver = $receiver;
        $this->message = $message;
    }

    /**
     * @return array
     */
    protected function buildQuery(): array
    {
        $query = [
            "numbers" => $this->receiver->getReceiver(),
            "message" => $this->message->getMessage()
        ];

        // remove null entries
        return array_filter($query);
    }

    /**
     * @return string[]
     */
    protected function buildType(): array
    {
        return ['send_sms'=>'send_sms'];
    }

    /**
     * @return array
     */
    protected function buildAuth(): array
    {
        return array_merge(parent::buildAuth(), ['sender' => config('hisms.sender')]);
    }
}
