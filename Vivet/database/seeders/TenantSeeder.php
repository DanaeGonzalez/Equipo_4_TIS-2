<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Stancl\Tenancy\Database\Models\Tenant;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $tenantId = 'vivet';
        $domain = 'vivet.vetcodex.test';
        $dbName = 'tenant' . $tenantId; 

        // Verifica si ya existe la base de datos
        $dbExists = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?", [$dbName]);

        if ($dbExists) {
            echo "La base de datos '$dbName' ya existe. Se saltará la creación del tenant.\n";


            $tenant = Tenant::find($tenantId);
            if (!$tenant) {
                echo "El tenant con ID '$tenantId' no se encontró, pero la base existe. Revisa tu base de datos.\n";
                return;
            }
        } else {
            
            $tenant = Tenant::create([
                'id' => $tenantId,
                'name' => 'Vivet',
                'email' => 'vivet@gmail.cl', 
                'subdomain' => $tenantId, 
                'data' => null, 
            ]);

            $tenant->domains()->create([
                'domain' => $domain,
            ]);

            echo "Tenant '$tenantId' creado con dominio '$domain'.\n";
        }

        tenancy()->initialize($tenant);
        Artisan::call('tenants:migrate');
        tenancy()->end();

        echo "Migraciones ejecutadas para '$tenantId'.\n";
    }
}
