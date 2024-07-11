<?php

namespace App\Console\Commands\landlord;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SystemMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'landlord:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Landlord Migration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Stating Migration');
        $this->info('If Migration did not start Plz enter (YES)');
        Artisan::call('migrate --path=database/migrations/landlord/ --database=landlord');
        $this->info(Artisan::output());
    }
}
