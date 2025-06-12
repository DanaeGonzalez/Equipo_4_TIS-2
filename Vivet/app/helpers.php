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
     * Devuelve la URL de una imagen de tenant o una demo si no existe.
     */
    function tenant_image(string $key, string $demoPath = 'images/demo/logo.png'): string
    {
        $filename = tenant_setting($key);

        if (!$filename) {
            return asset($demoPath); // imagen de demo en /public
        }

        return tenant_asset('images/' . $filename);
    }
}

