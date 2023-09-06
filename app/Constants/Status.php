<?php

namespace App\Constants;

use Organi\Helpers\Constants\Constant;

class Status extends Constant
{
    public const UPLOADING_PDF = 1;

    public const OPTIMIZING_PDF = 2;

    public const CALLING_WEBHOOK = 3;

    public const SUCCESSFUL = 10;

    public const WRONG_EXT = 11;

    public const INVALID_WEBHOOK_URL = 12;

    public const ERROR_WEBHOOK = 13;

    public const INVALID_HOST = 14;

    public const COULDNT_RETRIEVE_FILE = 15;

    public static function descriptions(): array
    {
        return [
            self::UPLOADING_PDF         => 'Uploading pdf',
            self::OPTIMIZING_PDF        => 'Optimizing pdf',
            self::CALLING_WEBHOOK       => 'Calling webhook',
            self::SUCCESSFUL            => 'Success',
            self::WRONG_EXT             => 'Wrong extension',
            self::INVALID_WEBHOOK_URL   => 'Invalid webhook URL',
            self::ERROR_WEBHOOK         => 'Error on callback',
            self::INVALID_HOST          => 'Host couldn\'t resolve',
            self::COULDNT_RETRIEVE_FILE => 'Couldn\'t retrieve file',
        ];
    }

    public static function color(int $value): string
    {
        if (in_array($value, [self::SUCCESSFUL])) {
            return 'green';
        }

        if (in_array($value, [self::UPLOADING_PDF, self::OPTIMIZING_PDF, self::CALLING_WEBHOOK])) {
            return 'yellow';
        }

        return 'red';
    }
}
