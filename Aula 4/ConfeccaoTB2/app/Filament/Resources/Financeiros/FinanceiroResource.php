<?php

namespace App\Filament\Resources\Financeiros;

use App\Filament\Resources\Financeiros\Pages\CreateFinanceiro;
use App\Filament\Resources\Financeiros\Pages\EditFinanceiro;
use App\Filament\Resources\Financeiros\Pages\ListFinanceiros;
use App\Filament\Resources\Financeiros\Pages\ViewFinanceiro;
use App\Filament\Resources\Financeiros\Schemas\FinanceiroForm;
use App\Filament\Resources\Financeiros\Tables\FinanceirosTable;
use App\Models\Financeiro;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FinanceiroResource extends Resource
{
    protected static ?string $model = Financeiro::class;

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static ?string $navigationGroup = 'Financeiro';

    protected static ?string $recordTitleAttribute = 'descricao';

    public static function form(Schema $schema): Schema
    {
        return FinanceiroForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FinanceirosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFinanceiros::route('/'),
            'create' => CreateFinanceiro::route('/create'),
            'view' => ViewFinanceiro::route('/{record}'),
            'edit' => EditFinanceiro::route('/{record}/edit'),
        ];
    }
}
