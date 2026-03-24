<?php

namespace App\Filament\Resources\Produtos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ProdutoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Produto')
                    ->description('Dados básicos do produto.')
                    ->schema([
                        TextInput::make('nome')
                            ->required()
                            ->live(onBlur: true)
                            ->label('Nome do Produto')
                            ->placeholder('Ex: Camiseta Algodão Premium')
                            ->columnSpanFull(),

                        Textarea::make('descricao')
                            ->label('Descrição')
                            ->placeholder('Detalhes técnicos, material, etc.')
                            ->columnSpanFull(),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('preco')
                                    ->label('Preço de Venda')
                                    ->numeric()
                                    ->prefix('R$')
                                    ->required(),

                                TextInput::make('estoque')
                                    ->label('Estoque Atual')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),

                                Select::make('categoria')
                                    ->label('Categoria')
                                    ->options([
                                        'camisetas' => 'Camisetas',
                                        'calcas'    => 'Calças',
                                        'acessorios' => 'Acessórios',
                                    ])
                                    ->searchable(),
                            ]),
                    ]),

                Section::make('Configurações')
                    ->schema([
                        Toggle::make('ativo')
                            ->label('Produto Ativo para Venda')
                            ->default(true),
                    ]),
            ]);
    }
}
