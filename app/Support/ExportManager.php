<?php

namespace App\Support;

use App\Models\Product;
use Error;
use Exception;
use Illuminate\Support\Traits\ForwardsCalls;

class ExportManager
{

    use ForwardsCalls;

    private function getExporter($type)
    {
        try {
            $classname = "App\\Support\\Exporters\\{$type}Exporter";
            return new $classname(Product::all());
        } catch (Error | Exception $e) {
            throw $e;
        }
    }

    public function download()
    {
        return "Dowloading last export";
    }

    public function __call($method, $parameters)
    {
        // removing the first parameter because it's the export format
        $type = ucfirst(strtolower(array_shift($parameters)));

        return $this->forwardDecoratedCallTo($this->getExporter($type), $method, $parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
}
