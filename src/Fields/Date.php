<?php


namespace Package\Development\Fields;


use Carbon\Carbon;

class Date
{

    public static function process($type, $value)
    {
        return [
            $type => Carbon::parse($value),
        ];
    }

}