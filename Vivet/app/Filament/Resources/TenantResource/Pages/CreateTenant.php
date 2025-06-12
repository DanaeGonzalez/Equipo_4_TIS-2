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

            // Fondos generales
            ['key' => 'colors.bg_base',         'value' => '#ffffff', 'type' => 'color', 'group' => 'colors', 'is_demo' => true], // Fondo general
            ['key' => 'colors.section.bg',        'value' => '#f9f9f9', 'type' => 'color', 'group' => 'colors', 'is_demo' => true], // Fondo de secciones individuales
            ['key' => 'colors.section.alt_bg',    'value' => '#e0f7f6', 'type' => 'color', 'group' => 'colors', 'is_demo' => true], // para alternar
            // Header
            ['key' => 'colors.header.bg',         'value' => '#fefdf1', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.header.text',       'value' => '#242323', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            // Topbar (franja superior)
            ['key' => 'colors.topbar.bg',         'value' => '#54ac94', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.topbar.text',       'value' => '#ffffff', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            // Footer
            ['key' => 'colors.footer.bg',         'value' => '#fefdf1', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.footer.text',       'value' => '#242323', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            // Texto
            ['key' => 'colors.text_primary',    'value' => '#1f2937', 'type' => 'color', 'group' => 'colors', 'is_demo' => true], // Texto principal
            ['key' => 'colors.text_heading',    'value' => '#3B6D8C', 'type' => 'color', 'group' => 'colors', 'is_demo' => true], // Títulos
            ['key' => 'colors.text_subtitle',   'value' => '#6F85E3', 'type' => 'color', 'group' => 'colors', 'is_demo' => true], // Subtítulos
            // Botones
            ['key' => 'colors.btn_primary.bg',   'value' => '#24887d', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.btn_primary.text', 'value' => '#ffffff', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.btn_secondary.bg',   'value' => '#0e4f4d', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.btn_secondary.text', 'value' => '#ffffff', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.btn_success.bg',   'value' => '#54ac94', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.btn_success.text', 'value' => '#ffffff', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.btn_danger.bg',    'value' => '#c0392b', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.btn_danger.text',  'value' => '#ffffff', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.btn_warning.bg',   'value' => '#faebca', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.btn_warning.text', 'value' => '#1f2937', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.btn_neutral.bg',   'value' => '#f3f4f6', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.btn_neutral.text', 'value' => '#1f2937', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            // Elementos destacados
            ['key' => 'colors.highlight_1',     'value' => '#14bdc4', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],
            ['key' => 'colors.highlight_2',     'value' => '#faebca', 'type' => 'color', 'group' => 'colors', 'is_demo' => true], // Ej: decorativo, separadores
            // Servicios o íconos (círculos)
            ['key' => 'colors.icon_bg',         'value' => '#faebca', 'type' => 'color', 'group' => 'colors', 'is_demo' => true],



            // Otros campos básicos demo
            ['key' => 'landing.title', 'value' => 'Aquí puedes poner el título de tu página', 'type' => 'string', 'group' => 'landing', 'is_demo' => true],
            ['key' => 'landing.subtitle', 'value' => 'Un eslogan llamativo para tus clientes', 'type' => 'text', 'group' => 'landing', 'is_demo' => true],
            ['key' => 'landing.cta_text', 'value' => 'Reserva una cita', 'type' => 'string', 'group' => 'landing', 'is_demo' => true],

            //Info de contacto
            ['key' => 'contact.number', 'value' => '+56912345678', 'type' => 'string', 'group' => 'contact', 'is_demo' => true],
            ['key' => 'contact.email', 'value' => 'contacto@tuclinica.cl', 'type' => 'string', 'group' => 'contact', 'is_demo' => true],
            ['key' => 'contact.tiktok', 'value' => 'TuTiktok', 'type' => 'string', 'group' => 'contact', 'is_demo' => true],
            ['key' => 'contact.facebook', 'value' => 'Tufacebook', 'type' => 'string', 'group' => 'contact', 'is_demo' => true],
            ['key' => 'contact.instagram', 'value' => 'Tuinstagram', 'type' => 'string', 'group' => 'contact', 'is_demo' => true],

            // Imagenes
            ['key' => 'images.logo', 'value' => '', 'type' => 'image', 'group' => 'images', 'is_demo' => true],
            ['key' => 'images.logo1', 'value' => '', 'type' => 'image', 'group' => 'images', 'is_demo' => true],
            ['key' => 'images.logo2', 'value' => '', 'type' => 'image', 'group' => 'images', 'is_demo' => true],
            ['key' => 'images.carousel1', 'value' => '', 'type' => 'image', 'group' => 'images', 'is_demo' => true],
            ['key' => 'images.carousel2', 'value' => '', 'type' => 'image', 'group' => 'images', 'is_demo' => true],
            ['key' => 'images.carousel3', 'value' => '', 'type' => 'image', 'group' => 'images', 'is_demo' => true],
            ['key' => 'images.carousel4', 'value' => '', 'type' => 'image', 'group' => 'images', 'is_demo' => true],
            ['key' => 'images.carousel5', 'value' => '', 'type' => 'image', 'group' => 'images', 'is_demo' => true],
            ['key' => 'images.content', 'value' => '', 'type' => 'image', 'group' => 'images', 'is_demo' => true],

        ];

        foreach ($demoSettings as $setting) {
            Setting::create(array_merge($setting, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
