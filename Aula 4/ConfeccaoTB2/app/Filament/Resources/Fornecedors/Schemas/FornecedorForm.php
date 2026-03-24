<?php

namespace App\Filament\Resources\Fornecedors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section; // CORRIGIDO: era Filament\Forms\Components\Section
use Filament\Schemas\Components\Grid;    // CORRIGIDO: era Filament\Forms\Components\Grid
use Filament\Support\RawJs;
use Filament\Schemas\Schema;

class FornecedorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Fornecedor')
                    ->description('Dados principais e de contato.')
                    ->schema([
                        TextInput::make('nome')
                            ->required()
                            ->label('Nome/Razão Social')
                            ->placeholder('Ex: Fornecedor de Tecidos LTDA')
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('email')
                                    ->label('E-mail')
                                    ->email()
                                    ->placeholder('contato@fornecedor.com'),

                                TextInput::make('telefone')
                                    ->label('Telefone')
                                    ->tel()
                                    ->mask(RawJs::make("'(99) 99999-9999'"))
                                    ->placeholder('(00) 00000-0000'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Select::make('tipo_pessoa')
                                    ->label('Tipo de Pessoa')
                                    ->options([
                                        'CNPJ' => 'Jurídica (CNPJ)',
                                        'CPF'  => 'Física (CPF)',
                                    ])
                                    ->default('CNPJ')
                                    ->required()
                                    ->live()                   // CORRIGIDO: reactive() depreciado no Filament v3
                                    ->afterStateUpdated(fn ($set) => $set('cpf', null)),

                                TextInput::make('cpf')
                                    ->label(fn ($get) => $get('tipo_pessoa') === 'CPF' ? 'CPF' : 'CNPJ')
                                    ->mask(fn ($get) => $get('tipo_pessoa') === 'CPF'
                                        ? RawJs::make("'999.999.999-99'")
                                        : RawJs::make("'99.999.999/9999-99'"))
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->placeholder(fn ($get) => $get('tipo_pessoa') === 'CPF' ? '000.000.000-00' : '00.000.000/0000-00'),
                            ]),
                    ]),

                Section::make('Localização')
                    ->description('Endereço completo do fornecedor.')
                    ->schema([
                        TextInput::make('endereco')
                            ->label('Endereço')
                            ->placeholder('Rua, Número, Bairro')
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('cidade')
                                    ->label('Cidade')
                                    ->placeholder('Ex: São Paulo'),

                                TextInput::make('estado')
                                    ->label('Estado')
                                    ->maxLength(2)
                                    ->placeholder('Ex: SP'),
                            ]),
                    ]),

                Section::make('Status')
                    ->schema([
                        Toggle::make('ativo')
                            ->label('Fornecedor Ativo')
                            ->default(true),
                    ]),
            ]);
    }
}