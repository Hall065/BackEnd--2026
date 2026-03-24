<?php

namespace App\Filament\Resources\Financeiros\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FinanceiroInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('descricao'),
                TextEntry::make('tipo'),
                TextEntry::make('valor')
                    ->numeric(),
                TextEntry::make('data_vencimento')
                    ->date(),
                TextEntry::make('data_pagamento')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
