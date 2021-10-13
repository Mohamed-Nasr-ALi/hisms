<?php

namespace Ibtdi\HiSms\Response\Mapper;

/**
 * Class ResponseMapper
 */
class ResponseMapper
{

    /**
     * @param  string  $number
     * @return string
     */
    public function getResponseMsgByNumber(string $number): string
    {
        return app()->get(config('hisms.response_lang').'_response_guide')[$number] ?? 'Not Covered Response';
    }
}
