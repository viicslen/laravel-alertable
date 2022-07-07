<?php

namespace ViicSlen\LaravelAlertable\Enums;

enum Severity: string
{
    case None = 'None';
    case Info = 'Info';
    case Success = 'Success';
    case Warning = 'Warning';
    case Error = 'Error';

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }
}
