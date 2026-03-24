<?php

namespace App\Filament\Resources\Clientes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section; // CORRIGIDO: era Filament\Forms\Components\Section
use Filament\Schemas\Components\Grid;    // CORRIGIDO: era Filament\Forms\Components\Grid
use Filament\Support\RawJs;
use Filament\Schemas\Schema;

class ClienteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações')
                    ->description('Dados principais e de contato.')
                    ->schema([
                        TextInput::make('nome')
                            ->required()
                            ->label('Nome Completo')
                            ->placeholder('Ex: João Silva')
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('email')
                                    ->email()
                                    ->unique(ignoreRecord: true)
                                    ->label('E-mail')
                                    ->placeholder('joao@exemplo.com'),

                                TextInput::make('telefone')
                                    ->tel()
                                    ->mask(RawJs::make("'(99) 99999-9999'"))
                                    ->label('Telefone')
                                    ->placeholder('(00) 00000-0000'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Select::make('tipo_pessoa')
                                    ->label('Tipo de Pessoa')
                                    ->options([
                                        'CPF'  => 'Física (CPF)',
                                        'CNPJ' => 'Jurídica (CNPJ)',
                                    ])
                                    ->default('CPF')
                                    ->required()               // CORRIGIDO: adicionado required()
                                    ->live()                   // CORRIGIDO: reactive() depreciado no Filament v3
                                    ->afterStateUpdated(fn ($set) => $set('cpf', null)),

                                TextInput::make('cpf')
                                    ->label(fn ($get) => $get('tipo_pessoa') === 'CNPJ' ? 'CNPJ' : 'CPF')
                                    ->mask(fn ($get) => $get('tipo_pessoa') === 'CNPJ'
                                        ? RawJs::make("'99.999.999/9999-99'")
                                        : RawJs::make("'999.999.999-99'"))
                                    ->required()               // CORRIGIDO: adicionado required()
                                    ->unique(ignoreRecord: true),
                            ]),
                    ]),

                Section::make('Localização')
                    ->description('Endereço completo para entregas e cobrança.')
                    ->schema([
                        TextInput::make('endereco')
                            ->label('Logradouro')
                            ->placeholder('Rua, Número, Bairro')
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('cidade')
                                    ->label('Cidade')
                                    ->placeholder('Ex: São Paulo'),

                                TextInput::make('estado')
                                    ->label('UF')
                                    ->maxLength(2)
                                    ->placeholder('SP'),
                            ]),
                    ]),

                Section::make('Status')
                    ->schema([
                        Toggle::make('ativo')
                            ->default(true)
                            ->label('Ativo'),
                    ]),
            ]);
    }
}