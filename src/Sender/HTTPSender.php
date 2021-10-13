<?php

namespace Ibtdi\HiSms\Sender;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Ibtdi\HiSms\Request\SmsRequest;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BaseSender.
 */
abstract class HTTPSender
{
    /**
     * The client used to send messages.
     *
     * @var ClientInterface
     */
    protected $client;

    /**
     * The URL entry point.
     *
     * @var string
     */
    protected $url;

    /**
     * Initializes a new sender object.
     *
     * @param  ClientInterface  $client
     * @param  string  $url
     */
    public function __construct(ClientInterface $client, string $url)
    {
        $this->client = $client;
        $this->url = $url;
    }

    /**
     * @param  SmsRequest  $request
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function post(SmsRequest $request): ResponseInterface
    {
        try {
            $responseGuzzle = $this->client->request('get', $this->url, $request->build());
        } catch (ClientException $e) {
            $responseGuzzle = $e->getResponse();
        }

        return $responseGuzzle;
    }
}
