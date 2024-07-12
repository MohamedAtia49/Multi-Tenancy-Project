<?php

namespace App\Console\Commands\Tenants;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tenant creation';

    /**
     * Execute the console command.
     */
    public function handle(Tenant $tenant, $client)
    {
        try {
            $dbUser = config('create_tenant.DB_USERNAME');
            $dbPassword = config('create_tenant.DB_PASSWORD');

            // Ensure the DB user has the necessary privileges
            if (!$dbUser || !$dbPassword) {
                throw new \Exception('Database user credentials are not set properly.');
            }

            // CREATE DATABASE
            DB::statement('CREATE DATABASE ' . $tenant->database);

            // GRANT ALL PRIVILEGES
            DB::statement("GRANT ALL PRIVILEGES ON " . $tenant->database . ".* TO '" . $dbUser . "'@'%' IDENTIFIED BY '" . $dbPassword . "'");

            // MIGRATION
            Artisan::call('tenants:artisan "migrate --path=database/migrations/company" --tenant=' . $tenant->id);

            // Artisan::call('tenants:artisan "migrate --seed" --tenant=' . $tenant->id);

            // CREATE ADMIN
            DB::insert("INSERT INTO {$tenant->database}.users (name,email,user_type,password) VALUES (?,?,?,?)", [$client->name, $client->email, 'admin', $client->password]);

        } catch (\Exception $e) {
            Log::error("TenantController - activate: " . $e->getMessage());
        }
    }
}
