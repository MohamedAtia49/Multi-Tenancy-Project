<?php

namespace App\Console\Commands\landlord;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'landlord:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Landlord Seeding';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Start Seeding');
        $this->info('-------------------------------------------');
        Artisan::call('db:seed' ,[
        '--class' => 'Database\\Seeders\\landlord\\TenantSeeder',
        '--database'=> 'landlord',
        ]);
        $this->info(Artisan::output());
    }
}
