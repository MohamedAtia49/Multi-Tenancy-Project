<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TenantService{
    private static $tenant;
    private static $domain;
    private static $database;
    public static function SwitchToTenant(Tenant $tenant){

        if(!$tenant instanceof Tenant){
            //Throw Exception
            throw ValidationException::withMessages(['filed_name' => 'This Value not incorrect']);
        }
        Self::$tenant = $tenant;
        Self::$domain = $tenant->domain;
        Self::$database = $tenant->database;

        DB::purge('landlord');
        DB::purge('tenant');
        Config::set('database.connections.tenant.database',$tenant->database);
        DB::reconnect('tenant');
        DB::setDefaultConnection('tenant');
    }

    public static function SwitchToDefault(Tenant $tenant){
        DB::purge('landlord');
        DB::purge('tenant');
        DB::reconnect('landlord');
        DB::setDefaultConnection('landlord');
    }

    public static function getTenant($tenant){
        return Self::$tenant;
    }
}
