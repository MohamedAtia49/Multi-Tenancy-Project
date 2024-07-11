<?php

namespace App\Console\Commands\tenants;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:seed {class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $class = $this->argument('class');
        $tenants = Tenant::get();
        $tenants->each(function ($tenant) use ($class){
            TenantService::SwitchToTenant($tenant);
            $this->info('Start Seeding : '. $tenant->domain);
            $this->info('-----------------------------');
            Artisan::call('db:seed' , [
                '--class' => 'Database\\Seeders\\tenants\\'.$class,
                '--database' => 'tenant',
            ]);
            $this->info(Artisan::output());
        });
    }
}
