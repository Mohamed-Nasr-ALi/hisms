<?php

namespace Ibtdi\HiSms\Request\Components;

use Exception;

class Receiver
{

    /**
     * @var string
     */
    private $receiver;

    /**
     * @return string
     */
    public function getReceiver(): string
    {
        return $this->receiver;
    }

    /**
     * @param array $receiver
     * @throws Exception
     */
    public function __construct(array $receiver)
    {
        if (empty($receiver)) {
            throw new Exception('must provider at least one valid number inside an array to send sms!');
        }
        $this->receiver = implode(',', $receiver);
    }
}
