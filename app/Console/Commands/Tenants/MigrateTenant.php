<?php

namespace App\Console\Commands\Tenants;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tenants Migration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenants = Tenant::get();
        $tenants->each(function($tenant){
            TenantService::SwitchToTenant($tenant);
            $this->info('IF Database Migration not worked for this domain :' .$tenant->domain . 'Plz Enter (Yes)');
            $this->info('-------------------------------------------------');
            $this->info('If it worked so its Great');
            Artisan::call('migrate --path=database/migrations/tenants/ --database=tenant');
            $this->info(Artisan::output());
        });
    }
}
