<?php

namespace App\Support\Exporters;

use App\Support\Exporters\IExporter;

class XmlExporter implements IExporter
{
    public static $filetype = "XML";
    private $items;
    private $model;
    public $lastExportId;

    public function __construct($_model)
    {
        $this->model = $_model;
    }

    public function prepareExport()
    {
        $this->items = $this->model::all();

        echo "Preparing export of " . get_class(new $this->model);
        echo "\n";
    }

    public function export()
    {
        $this->prepareExport();

        echo "{$this->items->count()} records exported in " . static::$filetype . " format";
        echo "\n";

        return $this;
    }

    public function save()
    {
        $this->lastExportId = rand(1, 1305);

        echo "Export n. {$this->lastExportId} saved inside database";
        echo "\n";

        return $this;
    }
}
