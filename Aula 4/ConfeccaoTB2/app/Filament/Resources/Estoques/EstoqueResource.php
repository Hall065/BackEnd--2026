<?php

namespace App\Filament\Resources\Estoques;

use App\Filament\Resources\Estoques\Pages\CreateEstoque;
use App\Filament\Resources\Estoques\Pages\EditEstoque;
use App\Filament\Resources\Estoques\Pages\ListEstoques;
use App\Filament\Resources\Estoques\Pages\ViewEstoque;
use App\Filament\Resources\Estoques\Schemas\EstoqueInfolist;
use App\Models\Estoque;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use App\Filament\Resources\BaseResource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class EstoqueResource extends BaseResource
{
    protected static ?string $model = Estoque::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?string $navigationLabel = 'Estoques';

    protected static ?string $recordTitleAttribute = 'produto.nome';

    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('produto_id')
                ->relationship('produto', 'nome')
                ->label('Produto')
                ->searchable()
                ->preload()
                ->required()
                ->unique(ignoreRecord: true) // 1 produto → 1 estoque
                ->createOptionForm([
                    TextInput::make('nome')
                        ->label('Nome do Produto')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('referencia')
                        ->label('Referência/SKU'),
                    TextInput::make('preco_venda')
                        ->label('Preço de Venda')
                        ->numeric()
                        ->prefix('R$'),
                ])
                ->columnSpan(2),

            TextInput::make('quantidade')
                ->label('Quantidade Atual')
                ->numeric()
                ->minValue(0)
                ->default(0)
                ->required()
                ->columnSpan(1),

            TextInput::make('localizacao')
                ->label('Localização no Depósito')
                ->placeholder('Ex: Corredor A, Prateleira 2')
                ->columnSpan(1),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EstoqueInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('produto.nome')
                    ->label('Produto')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('produto.referencia')
                    ->label('Ref/SKU')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('quantidade')
                    ->label('Qtd. em Estoque')
                    ->badge()
                    ->color(fn (int $state): string => match(true) {
                        $state <= 0 => 'danger',
                        $state <= 5 => 'warning',
                        default     => 'success',
                    })
                    ->sortable(),

                TextColumn::make('localizacao')
                    ->label('Localização')
                    ->searchable()
                    ->placeholder('Não definida'),

                TextColumn::make('updated_at')
                    ->label('Última Atualização')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('estoque_baixo')
                    ->label('Estoque Baixo (≤ 5)')
                    ->query(fn (Builder $query) => $query->where('quantidade', '<=', 5)),

                Filter::make('zerado')
                    ->label('Zerado')
                    ->query(fn (Builder $query) => $query->where('quantidade', '<=', 0)),
            ])
            ->defaultSort('quantidade', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListEstoques::route('/'),
            'create' => CreateEstoque::route('/create'),
            'view'   => ViewEstoque::route('/{record}'),
            'edit'   => EditEstoque::route('/{record}/edit'),
        ];
    }
}