<?php

namespace Ibtdi\HiSms\Sender;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Ibtdi\HiSms\Request\Components\Message;
use Ibtdi\HiSms\Request\Components\Receiver;
use Ibtdi\HiSms\Request\SmsRequest;
use Ibtdi\HiSms\Response\Response;

/**
 * Class HISmsSender
 */
class HISmsSender extends HTTPSender
{
    /**
     * @var
     */
    private $receiver;
    /**
     * @var
     */
    private $message_content;
    /**
     * @var
     */
    private $response;

    /**
     * @param  array  $to
     * @return HISmsSender
     * @throws Exception
     */
    public function to(array $to): HISmsSender
    {
        $this->receiver = new Receiver($to);
        return $this;
    }

    /**
     * @param  string  $message
     * @return HISmsSender
     * @throws Exception
     */
    public function message(string $message): HISmsSender
    {
        $this->message_content = new Message($message);
        return $this;
    }

    /**
     * @return HISmsSender|null
     * @throws Exception|GuzzleException
     */
    public function send(): ?Response
    {
        if (!empty($this->receiver->getReceiver()) && !empty($this->message_content->getMessage())) {
            $request = new SmsRequest($this->receiver, $this->message_content);
            $responseGuzzle = $this->post($request);
            $this->response = new Response($responseGuzzle);
        }
        return $this->response ?? null;
    }
}
