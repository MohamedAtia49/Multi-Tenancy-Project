<?php

namespace Database\Seeders\Landlord;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            ['name' => 'tenant1','domain' => 'app1.multi-tenant.test','database' => 'tenant1'],
            ['name' => 'tenant2','domain' => 'app2.multi-tenant.test','database' => 'tenant2'],
        ];

        Tenant::insert($tenants);
    }
}
