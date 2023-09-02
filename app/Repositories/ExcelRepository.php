<?php

namespace App\Repositories;

use App\Enums\ExcelStatus;
use App\Jobs\ParseExcelJob;
use App\Repositories\Interfaces\IExcelRepo;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelRepository implements IExcelRepo
{
    protected $filePath;
    public function upload($filePath)
    {
        $this->filePath = $filePath->store('public');
        return $this->filePath;
    }

    public function processData($filePath): string
    {
        $spreadsheet = IOFactory::load(storage_path('app/' . $this->filePath));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $progressKey = ExcelStatus::getProgressKey();
        Redis::set($progressKey, 0);

        foreach (array_chunk($rows, 1000) as $chunk) {
            dispatch(new ParseExcelJob($chunk, $progressKey));
        }

        return $progressKey;
    }

}
