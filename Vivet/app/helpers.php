<?php

use App\Models\Setting;
use Stancl\Tenancy\Resolvers\ContractTenantResolver;
use Illuminate\Support\Facades\Storage;

// Helper padre

if (!function_exists('tenant_setting')) {
    function tenant_setting(string $key, $default = null): ?string {
        if (!function_exists('tenant') || !tenant()) {
            return $default;
        }

        $value = \App\Models\Setting::where('key', $key)->value('value');

        return $value !== null && $value !== '' ? $value : $default;
    }
}


if (!function_exists('tenant_image')) {
    /**
     * Devuelve la URL de una imagen del tenant o una imagen demo si no hay valor.
     *
     * @param string $key Clave de settings, como 'images.logo' o 'images.carousel1'
     * @param string $demoPath Ruta relativa en /public para imagen demo (ej: 'images/demo/logo.png')
     * @return string URL completa de la imagen
     */
    function tenant_image(string $key, string $demoPath = 'images/demo/logo.png'): string
    {
        $filename = tenant_setting($key);

        return $filename
            ? tenant_asset('images/' . $filename)
            : asset($demoPath);
    }
}


