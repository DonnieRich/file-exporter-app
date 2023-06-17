<?php

namespace App\Support\Exporters;

use App\Support\Exporters\IExporter;
use App\Models\Product;

class CsvExporter implements IExporter
{
    public static $filetype = "CSV";
    private $products;

    public function __construct($_products)
    {
        $this->products = $_products;
    }

    public function export($filename)
    {
        $filename = $filename ? $filename . "." . static::$filetype : "default." . static::$filetype;

        echo "{$this->products->count()} Products exported in " . static::$filetype . " format, inside $filename";
        echo "\n";

        return $this;
    }
}
