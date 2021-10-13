<?php

namespace Ibtdi\HiSms\Tests\Feature;

use Ibtdi\HiSms\Facades\Mapper;
use Ibtdi\HiSms\Tests\TestCase;

/**
 * Class ResponseMapperTest
 */
class ResponseMapperTest extends TestCase
{
    /** @test */
    public function is_mapper_read_correctly_from_guide_file(): void
    {
        $rand = array_rand($this->app[(config('hisms.response_lang').'_response_guide')]);
        $this->assertEquals(
            $this->app[(config('hisms.response_lang').'_response_guide')][$rand],
            Mapper::getResponseMsgByNumber($rand)
        );
    }
}
