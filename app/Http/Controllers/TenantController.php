<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TenantController extends Controller
{
    public function index (){
        dd(DB::getDefaultConnection());
    }

    public function store(Request $request){
        $tenant = $request->name;
        Tenant::create([
            'name' => $request->name,
            'domain' => $request->domain,
            'database' => $request->name,
        ]);
        Artisan::queue('database:create');
        //TenantService::SwitchToTenant($tenant);
        return redirect()->route('default');
    }


private function createNewTenant(Tenant $tenant,$client)
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
