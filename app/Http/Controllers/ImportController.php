<?php

namespace App\Http\Controllers;

use App\Enums\ExcelStatus;
use App\Http\Requests\ReqFileExcel;
use App\Jobs\ParseExcelJob;
use App\Models\Rows;
use App\Repositories\ExcelRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class ImportController extends Controller
{
    /**
     * @throws \RedisException
     */
    public function upload(ReqFileExcel $request, ExcelRepository $excelRepository)
    {
        $request->validated();

        $file = $excelRepository->upload($request->file('file'));

        $progressKey = $excelRepository->processData($file);

        return JsonResource::make(['progress_key' => $progressKey]);
    }

    public function getImportedData()
    {
        $importedData = Rows::select('date', DB::raw('count(*) as total'))
            ->groupBy('date')
            ->get();

        return JsonResource::make(['data' => $importedData]);
    }
}
