<?php

namespace Ibtdi\HiSms\Response;

use Ibtdi\HiSms\Facades\Mapper;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Response.
 */
class Response
{

    /**
     * @var false|string
     */
    private $response_code;
    /**
     * @param  ResponseInterface  $responseGuzzle
     */
    public function __construct(ResponseInterface $responseGuzzle)
    {
        $this->response_code=strtok($responseGuzzle->getBody()->getContents(), '-');
    }

    /**
     * @return  bool
     */
    public function andGetStatus(): bool
    {
        return $this->response_code === app()->get('valid_response_keys')['send_sms'];
    }
    /**
     * @return  string
     */
    public function andGetMessage(): string
    {
        return Mapper::getResponseMsgByNumber($this->response_code);
    }
    /**
     * @return  int
     */
    public function andGetCode(): int
    {
        return $this->response_code;
    }

}
