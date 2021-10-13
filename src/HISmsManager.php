<?php

namespace Ibtdi\HiSms;

use GuzzleHttp\Client;

/**
 * Class HISmsManager
 */
class HISmsManager
{
    /**
     * @return Client
     */
    public function configure(): Client
    {
        return new Client();
    }
}
