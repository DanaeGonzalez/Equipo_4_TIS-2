<?php

use App\Models\Setting;
use Stancl\Tenancy\Resolvers\ContractTenantResolver;

if (!function_exists('tenant_setting')) {
    function tenant_setting(string $key, $default = null): ?string {
        if (!function_exists('tenant') || !tenant()) {
            return $default;
        }

        $value = \App\Models\Setting::where('key', $key)->value('value');

        return $value !== null && $value !== '' ? $value : $default;
    }
}
