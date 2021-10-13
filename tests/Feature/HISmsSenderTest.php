<?php

namespace Ibtdi\HiSms\Tests\Feature;

use Ibtdi\HiSms\Facades\HISms;
use Ibtdi\HiSms\Facades\Mapper;
use Ibtdi\HiSms\Tests\TestCase;

/**
 * Class HISmsSenderTest
 */
class HISmsSenderTest extends TestCase
{
    /**
     *PHONE1
     */
    private const PHONE1 = '96651112222';
    /**
     *PHONE1
     */
    private const PHONE2 = '96651113333';
    /**
     *VALID_KEY from  __DIR__.'/../../src/Response/Guide/valid_response_keys.php' file 'sms_type' key
     */
    private const VALID_KEY = 3;
    /**
     *
     */
    private const MESSAGE = 'hello world';

    /** @test */
    public function if_receiver_is_empty_array(): void
    {
        try {
            HISms::to([]);
            $this->fail('should not work');
        } catch (\Exception $exception) {
            $this->assertEquals(
                "must provider at least one valid number inside an array to send sms!",
                $exception->getMessage()
            );
        }
    }

    /** @test */
    public function if_message_is_empty_string(): void
    {
        try {
            HISms::message('');
            $this->fail('should not work');
        } catch (\Exception $exception) {
            $this->assertEquals("must provider message content!", $exception->getMessage());
        }
    }

    /** @test */
    public function if_send_sms_with_empty_data(): void
    {
        try {
            HISms::to([])->message('')->send();
            $this->fail('should not work');
        } catch (\Exception $exception) {
            $this->assertEquals(
                "must provider at least one valid number inside an array to send sms!",
                $exception->getMessage()
            );
        }
    }

    /** @test */
    public function send_sms_to_single_person_and_get_status(): void
    {
        $response = HISms::to([self::PHONE1])
            ->message(self::MESSAGE)
            ->send()
            ->andGetStatus();
        $this->assertTrue($response);
    }

    /** @test */
    public function send_sms_to_single_person_and_get_code(): void
    {
        $response = HISms::to([self::PHONE1])
            ->message(self::MESSAGE)
            ->send()
            ->andGetCode();
        $this->assertEquals(self::VALID_KEY, $response);
    }

    /** @test */
    public function send_sms_to_single_person_and_get_message(): void
    {
        $response = HISms::to([self::PHONE1])
            ->message(self::MESSAGE)
            ->send()
            ->andGetMessage();
        $this->assertEquals(Mapper::getResponseMsgByNumber(self::VALID_KEY), $response);
    }

    /** @test */
    public function send_sms_to_multi_persons_and_get_status(): void
    {
        $response = HISms::to([self::PHONE1, self::PHONE2])
            ->message(self::MESSAGE)
            ->send()
            ->andGetStatus();
        $this->assertTrue($response);
    }

    /** @test */
    public function send_sms_to_multi_persons_and_get_code(): void
    {
        $response = HISms::to([self::PHONE1, self::PHONE2])
            ->message(self::MESSAGE)
            ->send()
            ->andGetCode();
        $this->assertEquals(self::VALID_KEY, $response);
    }

    /** @test */
    public function send_sms_to_multi_persons_and_get_message(): void
    {
        $response = HISms::to([self::PHONE1, self::PHONE2])
            ->message(self::MESSAGE)
            ->send()
            ->andGetMessage();
        $this->assertEquals(Mapper::getResponseMsgByNumber(self::VALID_KEY), $response);
    }
}
