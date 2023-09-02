<?php

namespace App\Enums;

final class ExcelStatus
{
    const PROGRESS = 'import_progress';

    public static function getProgressKey() {
        return self::PROGRESS.':' . uniqid();
    }
}
