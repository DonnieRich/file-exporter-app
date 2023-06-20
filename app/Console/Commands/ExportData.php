<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Support\ExportManager;

class ExportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:export
                            {type : The export format: XML, CSV}
                            {class : The class to export: Product, User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export selected data in the given format';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $export = ExportManager::export($this->argument('type'), $this->argument('class'))->save();
        ExportManager::sendExport($export->lastExportId);
    }
}
