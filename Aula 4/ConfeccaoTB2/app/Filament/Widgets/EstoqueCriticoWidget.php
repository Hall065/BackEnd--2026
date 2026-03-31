<?php

namespace App\Filament\Widgets;

use App\Models\Estoque;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class EstoqueCriticoWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Estoque Crítico';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Estoque::with('produto')
                    ->where('quantidade', '<=', 5)
                    ->orderBy('quantidade', 'asc')
            )
            ->columns([
                TextColumn::make('produto.nome')
                    ->label('Produto')
                    ->searchable(),

                TextColumn::make('produto.referencia')
                    ->label('Ref/SKU')
                    ->placeholder('—'),

                TextColumn::make('quantidade')
                    ->label('Qtd.')
                    ->badge()
                    ->color(fn (int $state): string => match(true) {
                        $state <= 0 => 'danger',
                        default     => 'warning',
                    }),

                TextColumn::make('localizacao')
                    ->label('Localização')
                    ->placeholder('Não definida'),

                TextColumn::make('updated_at')
                    ->label('Última atualização')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->emptyStateHeading('Nenhum produto crítico')
            ->emptyStateDescription('Todos os produtos estão com estoque adequado.')
            ->emptyStateIcon('heroicon-o-check-circle')
            ->paginated(false);
    }
}