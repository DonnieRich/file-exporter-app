<?php

namespace App\Support\Exporters;

interface IExporter
{
    /**
     * Get the data from the model and prepare the export
     */
    public function prepareExport();

    /**
     * Create the export
     */
    public function export();

    /**
     * Save the export inside the database
     */
    public function save();
}
