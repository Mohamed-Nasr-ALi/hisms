<?php

namespace Ibtdi\HiSms\Request;

use GuzzleHttp\ClientInterface;

/**
 * Class BaseRequest.
 */
abstract class BaseRequest
{
    /**
     * @internal
     *
     * @var ClientInterface
     */
    protected $client;

    /**
     * @internal
     *
     * @var array
     */
    protected $config;

    /**
     * BaseRequest constructor.
     */
    public function __construct()
    {
        $this->config = app('config')->get('hisms.auth', []);
    }
    /**
     * Build the body of the request.
     *
     * @return mixed
     */
    abstract protected function buildQuery(): array;

    /**
     * @return array
     */
    abstract protected function buildType(): array;
    /**
     * Build the header for the request.
     *
     * @return array
     */
    protected function buildRequestHeader(): array
    {
        return [
            'Accept' => '*/*',
            'content-type' => 'application/json',
        ];
    }

    /**
     * @return array
     */
    protected function buildAuth(): array
    {
        return $this->config;
    }

    /**
     * Return the request in array form.
     *
     * @return array
     */
    public function build(): array
    {
        return [
            'headers' => $this->buildRequestHeader(),
            'query' => array_merge($this->buildType(), $this->buildAuth(), $this->buildQuery()),
        ];
    }

}
