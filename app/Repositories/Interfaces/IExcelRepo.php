<?php

namespace App\Repositories\Interfaces;

interface IExcelRepo
{
    public function upload($filePath);
    public function processData($filePath);
}
