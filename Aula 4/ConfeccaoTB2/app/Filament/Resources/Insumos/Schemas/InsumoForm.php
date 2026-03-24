<?php

namespace App\Filament\Resources\Insumos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InsumoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Insumo')
                    ->description('Dados da matéria-prima (tecidos, linhas, etc).')
                    ->schema([
                        TextInput::make('nome')
                            ->required()
                            ->label('Nome do Insumo')
                            ->placeholder('Ex: Tecido Algodão Branco')
                            ->columnSpanFull(),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('quantidade')
                                    ->required()
                                    ->numeric()
                                    ->default(0)
                                    ->label('Quantidade'),

                                Select::make('unidade')
                                    ->required()
                                    ->options([
                                        'm' => 'Metros (m)',
                                        'kg' => 'Quilos (kg)',
                                        'un' => 'Unidades (un)',
                                        'rolo' => 'Rolo',
                                    ])
                                    ->default('m')
                                    ->label('Unidade'),

                                TextInput::make('custo_unitario')
                                    ->required()
                                    ->numeric()
                                    ->prefix('R$')
                                    ->label('Custo Unitário'),
                            ]),

                        Select::make('fornecedor_id')
                            ->relationship('fornecedor', 'nome')
                            ->searchable()
                            ->preload()
                            ->label('Fornecedor')
                            ->placeholder('Selecione o fornecedor'),
                    ]),
            ]);
    }
}
