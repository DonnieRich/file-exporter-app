<?php

namespace App\Support\Exporters;

use App\Support\Exporters\IExporter;
use Illuminate\Support\Pluralizer;

class CsvExporter implements IExporter
{
    public static $filetype = "CSV";
    private $items;
    private $model;

    public function __construct($_items)
    {
        $this->items = $_items;
    }

    // public function prepareExport($model)
    // {
    //     $this->model = ucfirst(Pluralizer::plural($model));

    //     echo "Preparing export of {$this->model}";
    //     echo "\n";

    //     return $this;
    // }

    public function export($model)
    {
        $model = ucfirst(Pluralizer::plural($model));
        echo "{$this->items->count()} {$model} exported in " . static::$filetype . " format";
        echo "\n";

        return $this;
    }
}
