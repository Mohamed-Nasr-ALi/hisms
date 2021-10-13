<?php

namespace Ibtdi\HiSms\Request\Components;

use Exception;

/**
 * Class Message
 */
class Message
{

    /**
     * @var string
     */
    private $message;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @throws Exception
     */
    public function __construct(string $message)
    {
        if (empty($message)) {
            throw new Exception('must provider message content!');
        }
        $this->message = $message;
    }
}
