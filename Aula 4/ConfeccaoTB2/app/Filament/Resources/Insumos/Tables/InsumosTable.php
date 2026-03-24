<?php

namespace App\Filament\Resources\Insumos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InsumosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Insumo')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->fornecedor?->nome),

                TextColumn::make('quantidade')
                    ->label('Qtd')
                    ->formatStateUsing(fn ($state, $record) => $state . ' ' . $record->unidade)
                    ->sortable(),

                TextColumn::make('custo_unitario')
                    ->label('Custo')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('total_custo')
                    ->label('Custo Total')
                    ->money('BRL')
                    ->state(fn ($record) => $record->quantidade * $record->custo_unitario),

                TextColumn::make('created_at')
                    ->label('Cadastro')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('unidade')
                    ->label('Unidade')
                    ->options([
                        'm'    => 'Metros (m)',
                        'kg'   => 'Quilos (kg)',
                        'un'   => 'Unidades (un)',
                        'rolo' => 'Rolo',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
