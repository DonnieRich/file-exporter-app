<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Support\ExportManager;

class ExportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:export {type} {--filename=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export products data in the given format';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $result = ExportManager::export($this->argument('type'), $this->option('filename'))->download();
        $this->info($result);
    }
}
