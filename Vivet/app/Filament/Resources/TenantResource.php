<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Filament\Resources\TenantResource\RelationManagers;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;


class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Clínicas';
    protected static ?string $navigationGroup = 'Administración';
    protected static ?string $modelLabel = 'Clínica';
    protected static bool $shouldRegisterNavigation = true;
    protected static bool $shouldSkipAuthorization = true;
    protected $casts = [
        'data' => 'array',
    ];



    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nombre de la Clínica')
                ->required(),

            TextInput::make('email')
                ->label('Correo de la Clínica')
                ->email()
                ->required(),

            TextInput::make('subdomain')
                ->label('Subdominio')
                ->required(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //TextColumn::make('id')->label('ID'),
                TextColumn::make('name')->label('Nombre'),
                TextColumn::make('subdomain')->label('Subdominio'),
                TextColumn::make('email')->label('Correo'),
                TextColumn::make('created_at')->label('Creado')->dateTime('d/m/Y H:i'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('go')
                    ->label('Ir')
                    ->url(fn($record) => 'http://' . $record->subdomain . '.vetcodex.cl')
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('primary'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }

    // Para probar si se esta ocultando
    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    // Para probar si eran los permisos
    public static function canView(Model $record): bool
    {
        return true;
    }

    public static function getWidgets(): array
    {
        return [
            \App\Filament\Resources\TenantResource\Widgets\StatsOverview::class,
            //\App\Filament\Resources\TenantResource\Widgets\BienvenidaWidget::class,
        ];
    }
}
