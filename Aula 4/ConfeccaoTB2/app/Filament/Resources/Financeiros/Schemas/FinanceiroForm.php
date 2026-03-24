<?php

namespace App\Filament\Resources\Financeiros\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FinanceiroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações Financeiras')
                    ->description('Controle de entradas e saídas.')
                    ->schema([
                        TextInput::make('descricao')
                            ->required()
                            ->label('Descrição')
                            ->placeholder('Ex: Pagamento Fornecedor X')
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                Select::make('tipo')
                                    ->options([
                                        'receita' => 'Receita (Entrada)',
                                        'despesa' => 'Despesa (Saída)',
                                    ])
                                    ->required()
                                    ->label('Tipo'),

                                TextInput::make('valor')
                                    ->numeric()
                                    ->prefix('R$')
                                    ->required()
                                    ->label('Valor'),
                            ]),

                        Grid::make(3)
                            ->schema([
                                DatePicker::make('data_vencimento')
                                    ->required()
                                    ->label('Vencimento'),

                                DatePicker::make('data_pagamento')
                                    ->label('Pagamento'),

                                Select::make('status')
                                    ->options([
                                        'pendente' => 'Pendente',
                                        'pago' => 'Pago',
                                    ])
                                    ->default('pendente')
                                    ->required()
                                    ->label('Status'),
                            ]),
                    ]),
            ]);
    }
}
