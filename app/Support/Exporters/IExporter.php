<?php

namespace App\Support\Exporters;

interface IExporter
{
    // public function prepareExport($model);
    public function export($model);
}
