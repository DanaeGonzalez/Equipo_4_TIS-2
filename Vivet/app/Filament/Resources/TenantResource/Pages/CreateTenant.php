<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Tenant;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;

    protected function handleRecordCreation(array $data): Tenant
    {
        // 1. Creamos el tenant
        $tenant = Tenant::create([
            'id' => $data['subdomain'],
            'name' => $data['name'],
            'email' => $data['email'],
            'subdomain' => $data['subdomain'],
        ]);

        // 2. Asociamos el dominio
        $tenant->domains()->create([
            'domain' => $data['subdomain'] . '.' . config('tenancy.central_domains')[0],
        ]);

        // 3. Inicializamos el entorno del tenant
        tenancy()->initialize($tenant);

        // 4. Insertamos configuraciones demo
        $this->insertDefaultSettings();

        // 5. Finalizamos la inicialización
        tenancy()->end();

        return $tenant;
    }

    protected function insertDefaultSettings(): void
    {
        $now = now();
        $demoSettings = [
            // 🎨 Paleta completa de colores demo
            ['key' => 'colors.bg_main', 'value' => '#ffffff', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.bg_section', 'value' => '#36BBD9', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.title', 'value' => '#3B6D8C', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.subtitle', 'value' => '#6F85E3', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.text', 'value' => '#1f2937', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.button_secondary', 'value' => '#24928e', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.button_primary', 'value' => '#633b1f', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.accent_1', 'value' => '#14bdc4', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.accent_2', 'value' => '#6F85E3', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],

            // Otros campos básicos demo
            ['key' => 'landing.title', 'value' => 'Aquí puedes poner el título de tu página', 'type' => 'string', 'group' => 'landing', 'is_demo' => true],
            ['key' => 'landing.subtitle', 'value' => 'Un eslogan llamativo para tus clientes', 'type' => 'text', 'group' => 'landing', 'is_demo' => true],
            ['key' => 'landing.cta_text', 'value' => 'Reserva una cita', 'type' => 'string', 'group' => 'landing', 'is_demo' => true],
            ['key' => 'contact.email', 'value' => 'contacto@tuclinica.cl', 'type' => 'string', 'group' => 'contact', 'is_demo' => true],
            ['key' => 'images.logo', 'value' => 'images/tenants/demo/logo.png', 'type' => 'image', 'group' => 'images', 'is_demo' => true],
        ];

        foreach ($demoSettings as $setting) {
            Setting::create(array_merge($setting, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
