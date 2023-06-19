<?php

namespace App\Support;

use Error;
use Exception;
use Illuminate\Support\Traits\ForwardsCalls;

class ExportManager
{
    use ForwardsCalls;

    private function getExporter($type, $model)
    {
        try {
            $exporter = "App\\Support\\Exporters\\{$type}Exporter";
            $data = "App\\Models\\{$model}";
            return new $exporter($data::all());
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
        // removing the first element because it's the export format
        $type = ucfirst(strtolower(array_shift($parameters)));

        // retrieving the model
        $model = ucfirst(strtolower($parameters[0]));

        return $this->forwardCallTo($this->getExporter($type, $model), $method, $parameters);
        // return $this->forwardDecoratedCallTo($this->getExporter($type, $model), $method, $parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
}
