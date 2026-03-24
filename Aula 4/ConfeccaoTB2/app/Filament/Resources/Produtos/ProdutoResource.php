<?php

namespace App\Filament\Resources\Produtos;

use App\Filament\Resources\Produtos\Pages\ManageProdutos;
use App\Filament\Resources\Produtos\Schemas\ProdutoForm;
use App\Filament\Resources\Produtos\Tables\ProdutosTable;
use App\Models\Produto;
use BackedEnum;
use UnitEnum;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static string|UnitEnum|null $navigationGroup = 'Cadastros';

    protected static ?string $recordTitleAttribute = 'nome';

    public static function canViewAny(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        return $user?->isAdmin() ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return ProdutoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProdutosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageProdutos::route('/'),
        ];
    }
}
