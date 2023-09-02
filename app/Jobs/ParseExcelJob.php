<?php

namespace App\Jobs;

use App\Enums\ExcelStatus;
use App\Models\Rows;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class ParseExcelJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    protected $data;
    protected $progressKey;

    public function __construct($data, $progressKey)
    {
        $this->data = $data;
        $this->progressKey = $progressKey;
    }

    public function handle()
    {

        foreach ($this->data as $k => $rowData) {
            if (!isset($rowData[1]) || $k === 0) continue; // Skip column

            Rows::create([
                'name' => $rowData[1],
                'date' => Carbon::createFromFormat('d.m.Y', $rowData[2])->format('y.m.d')
            ]);

            Redis::incr($this->progressKey);
        }

    }
}
