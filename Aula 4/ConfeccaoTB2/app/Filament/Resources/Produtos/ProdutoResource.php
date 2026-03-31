<?php

namespace App\Filament\Resources\Produtos;

use App\Filament\Resources\Produtos\Pages\CreateProduto;
use App\Filament\Resources\Produtos\Pages\EditProduto;
use App\Filament\Resources\Produtos\Pages\ListProdutos;
use App\Filament\Resources\Produtos\Pages\ViewProduto;
use App\Filament\Resources\Produtos\Schemas\ProdutoInfolist;
use App\Models\Produto;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static ?string $navigationLabel = 'Produtos';

    protected static ?string $recordTitleAttribute = 'nome';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('nome')
                ->required()
                ->label('Nome do Produto')
                ->columnSpan(2),

            TextInput::make('referencia')
                ->label('Referência/SKU')
                ->columnSpan(1),

            TextInput::make('preco_venda')
                ->numeric()
                ->label('Preço de Venda')
                ->prefix('R$')
                ->columnSpan(1),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProdutoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->searchable()
                    ->sortable()
                    ->label('Produto'),

                TextColumn::make('referencia')
                    ->searchable()
                    ->label('Ref/SKU')
                    ->placeholder('—'),

                TextColumn::make('preco_venda')
                    ->money('BRL')
                    ->sortable()
                    ->label('Preço de Venda'),

                TextColumn::make('estoque.quantidade')
                    ->label('Qtd. em Estoque')
                    ->badge()
                    ->color(fn ($state): string => match(true) {
                        $state === null   => 'gray',
                        $state <= 0       => 'danger',
                        $state <= 5       => 'warning',
                        default           => 'success',
                    })
                    ->sortable(),

                TextColumn::make('estoque.localizacao')
                    ->label('Localização')
                    ->placeholder('Não definida')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('estoque_baixo')
                    ->label('Estoque Baixo (≤ 5)')
                    ->query(fn (Builder $query) => $query->whereHas(
                        'estoque', fn (Builder $q) => $q->where('quantidade', '<=', 5)
                    )),

                Filter::make('sem_estoque')
                    ->label('Sem Registro de Estoque')
                    ->query(fn (Builder $query) => $query->doesntHave('estoque')),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListProdutos::route('/'),
            'create' => CreateProduto::route('/create'),
            'view'   => ViewProduto::route('/{record}'),
            'edit'   => EditProduto::route('/{record}/edit'),
        ];
    }
}