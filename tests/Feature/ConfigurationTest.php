<?php

namespace Ibtdi\HiSms\Tests\Feature;

use Illuminate\Support\Facades\File;
use Ibtdi\HiSms\Tests\TestCase;

/**
 * Class ConfigFileTest
 */
class ConfigurationTest extends TestCase
{
    /**
     * HISMS config file path
     */
    private const CONFIG_FILE = __DIR__.'/../../config/hisms.php';
    /**
     * HISMS AR Response file path
     */
    private const AR_RESPONSE = __DIR__.'/../../src/Response/Guide/ar_guide.php';
    /**
     * HISMS EN Response file path
     */
    private const EN_RESPONSE = __DIR__.'/../../src/Response/Guide/en_guide.php';
    /**
     * HISMS Available Response file path
     */
    private const VALID_RES_KEYS = __DIR__.'/../../src/Response/Guide/valid_response_keys.php';

    /** @test */
    public function the_config_file_is_exists(): void
    {
        $this->assertTrue(File::exists(self::CONFIG_FILE));
    }

    /** @test */
    public function the_ar_message_response_file_is_exists(): void
    {
        $this->assertTrue(File::exists(self::AR_RESPONSE));
    }

    /** @test */
    public function the_en_message_response_file_is_exists(): void
    {
        $this->assertTrue(File::exists(self::EN_RESPONSE));
    }

    /** @test */
    public function the_valid_response_keys_file_is_exists(): void
    {
        $this->assertTrue(File::exists(self::VALID_RES_KEYS));
    }

    /** @test */
    public function valid_config_lang_exists(): void
    {
        $this->assertIsArray(['ar', 'en'], config('hisms.response_lang'));
    }
    /** @test */
    public function valid_send_sms_response_key_exists(): void
    {
        $this->assertIsString($this->app['valid_response_keys']['send_sms']);
    }
}
