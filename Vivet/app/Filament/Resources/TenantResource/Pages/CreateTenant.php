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
            'id' => $data['subdomain'], 
            'name' => $data['name'],
            'email' => $data['email'],
            'subdomain' => $data['subdomain'],
        ]);

        // Asociamos el dominio
        $tenant->domains()->create([
            'domain' => $data['subdomain'] . '.' . config('tenancy.central_domains')[0],
        ]);

        //depuracion
        $tenant = \App\Models\Tenant::find($tenant->id); // Forzar re-resolución

        // Crear la base de datos y correr las migraciones del tenant
        $tenant->database()->create();
        $tenant->database()->migrate();


        return $tenant;
    }
}
