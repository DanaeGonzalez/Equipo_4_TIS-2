<?php

namespace App\Filament\Resources\TenantResource\Pages;

use Stancl\Tenancy\Database\Models\Domain;
use App\Filament\Resources\TenantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Tenant;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;

    protected function handleRecordCreation(array $data): Tenant
    {
        // Creamos el tenant con los datos dentro del JSON `data`
        $tenant = Tenant::create([
            //'id' => $data['id'], 
            'name' => $data['name'],
            'email' => $data['email'],
            'subdomain' => $data['subdomain'],
        ]);

        // Asociamos el dominio
        $tenant->domains()->create([
            'domain' => $data['subdomain'] . '.' . config('tenancy.central_domains')[0],
        ]);

        // Crear la base de datos y correr las migraciones, descomentar si quiero manejar aca el flujo
        //$tenant->createDatabase();
        //$tenant->runMigrations();

        return $tenant;
    }
}
