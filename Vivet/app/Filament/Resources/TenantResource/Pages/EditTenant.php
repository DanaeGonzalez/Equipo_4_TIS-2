<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Stancl\Tenancy\Database\Models\Domain;

class EditTenant extends EditRecord
{
    protected static string $resource = TenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->before(function () {
                    $tenant = $this->record;

                    // Eliminar dominio relacionado
                    Domain::where('tenant_id', $tenant->id)->delete();

                    // Eliminar base de datos física
                    $dbName = 'tenant_' . $tenant->id;
                    DB::statement("DROP DATABASE IF EXISTS `$dbName`");

                    // Eliminar archivos si corresponde
                    File::deleteDirectory(storage_path("tenants/{$tenant->id}"));
                })
                ->requiresConfirmation()
                ->successNotificationTitle('Tenant eliminado permanentemente.'),
        ];
    }
}