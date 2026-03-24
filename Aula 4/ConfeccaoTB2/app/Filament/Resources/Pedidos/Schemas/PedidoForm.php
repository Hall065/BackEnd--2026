<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PedidoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Pedido')
                    ->description('Dados principais e status do pedido.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('cliente_id')
                                    ->relationship('cliente', 'nome')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->label('Cliente'),

                                Select::make('status')
                                    ->options([
                                        'pendente' => 'Pendente',
                                        'em_producao' => 'Em Produção',
                                        'pronto' => 'Pronto',
                                        'entregue' => 'Entregue',
                                        'cancelado' => 'Cancelado',
                                    ])
                                    ->default('pendente')
                                    ->required()
                                    ->label('Status'),

                                DatePicker::make('data_pedido')
                                    ->default(now())
                                    ->required()
                                    ->label('Data do Pedido'),

                                TextInput::make('total')
                                    ->numeric()
                                    ->prefix('R$')
                                    ->readOnly()
                                    ->label('Valor Total'),
                            ]),
                    ]),

                Section::make('Itens do Pedido')
                    ->description('Adicione os produtos e quantidades.')
                    ->schema([
                        Repeater::make('items')
                            ->relationship('items')
                            ->schema([
                                Select::make('produto_id')
                                    ->relationship('produto', 'nome')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->label('Produto')
                                    ->columnSpan(2)
                                    ->afterStateUpdated(function ($state, $set) {
                                        $produto = \App\Models\Produto::find($state);
                                        if ($produto) {
                                            $set('preco_unitario', $produto->preco);
                                        }
                                    })
                                    ->live(),

                                TextInput::make('quantidade')
                                    ->numeric()
                                    ->default(1)
                                    ->required()
                                    ->label('Qtd')
                                    ->columnSpan(1)
                                    ->live(),

                                TextInput::make('preco_unitario')
                                    ->numeric()
                                    ->prefix('R$')
                                    ->required()
                                    ->label('Preço Unit.')
                                    ->columnSpan(1)
                                    ->live(),

                                TextInput::make('subtotal')
                                    ->numeric()
                                    ->prefix('R$')
                                    ->state(fn ($get) => $get('quantidade') * $get('preco_unitario'))
                                    ->readOnly()
                                    ->label('Subtotal')
                                    ->columnSpan(1),
                            ])
                            ->columns(5)
                            ->label('Itens')
                            ->live()
                            ->afterStateUpdated(function ($state, $set) {
                                $total = 0;
                                foreach ($state as $item) {
                                    $total += ($item['quantidade'] ?? 0) * ($item['preco_unitario'] ?? 0);
                                }
                                $set('total', $total);
                            }),
                    ]),
            ]);
    }
}
