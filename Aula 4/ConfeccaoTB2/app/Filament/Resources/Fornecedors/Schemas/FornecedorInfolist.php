<?php

namespace App\Filament\Resources\Fornecedors\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FornecedorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nome'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('telefone')
                    ->placeholder('-'),
                TextEntry::make('tipo_pessoa'),
                TextEntry::make('cpf')
                    ->placeholder('-'),
                TextEntry::make('endereco')
                    ->placeholder('-'),
                TextEntry::make('cidade')
                    ->placeholder('-'),
                TextEntry::make('estado')
                    ->placeholder('-'),
                IconEntry::make('ativo')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
