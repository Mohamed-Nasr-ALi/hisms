<?php

namespace Ibtdi\HiSms\Tests\Feature;

use Ibtdi\HiSms\HISmsManager;
use Ibtdi\HiSms\Response\Mapper\ResponseMapper;
use Ibtdi\HiSms\Sender\HISmsSender;
use Ibtdi\HiSms\Tests\TestCase;

/**
 * Class ProviderRegisteringTest
 */
class ProviderRegisteringTest extends TestCase
{

    /** @test */
    public function get_client_guzzle_http(): void
    {
        $this->assertEquals((new HISmsManager())->configure(), $this->app['hisms.client']);
    }

    /** @test */
    public function get_mapper_object(): void
    {
        $this->assertEquals(new ResponseMapper(), $this->app['mapper']);
    }

    /** @test */
    public function get_sender_object(): void
    {
        $client = $this->app['hisms.client'];
        $url = $this->app['config']->get('hisms.sender_url');
        $this->assertEquals(new HISmsSender($client, $url), $this->app['hisms.sender']);
    }
}
