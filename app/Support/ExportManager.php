<?php

namespace App\Support;

use Error;
use Exception;
use Illuminate\Support\Traits\ForwardsCalls;

class ExportManager
{
    use ForwardsCalls;

    /**
     * Dynamically instantiate the exporter
     * 
     * @param string $type the Exporter type (i.e. Csv)
     * @param string $model the model to use in the export (i.e. Product)
     * 
     * @return mixed an instance of the exporter (i.e. CsvExporter, XmlExporter, etc...)
     */
    private function getExporter($type, $model)
    {
        try {

            // $type = Csv -> App\Support\Exporters\CsvExoporter
            $exporter = "App\\Support\\Exporters\\{$type}Exporter";

            // $model = Product -> App\Models\Product
            $data = "App\\Models\\{$model}";

            // new App\Support\Exporters\CsvExoporter(App\Models\Product)
            return new $exporter($data);
        } catch (Error | Exception $e) {
            throw $e;
        }
    }

    /**
     * List all export
     */
    public static function list()
    {
        echo "Listing all exports";
    }

    /**
     * Get the selected export and send it to the administrator email
     * 
     * @param int $id the ID of the export
     */
    public static function sendExport($id)
    {
        echo "Retrieving export number {$id}\n";
        echo "Sending selected export to administrator\n";
    }

    public function __call($method, $parameters)
    {
        // removing the first element because it's the export format
        // csv -> Csv
        $type = ucfirst(strtolower($parameters[0]));

        // retrieving the model
        $model = ucfirst(strtolower($parameters[1]));

        // forward the method call to the exporter instance
        return $this->forwardCallTo($this->getExporter($type, $model), $method, $parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
}
