<?php

namespace App\Filament\Resources\Financeiros\Pages;

use App\Filament\Resources\Financeiros\FinanceiroResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFinanceiros extends ListRecords
{
    protected static string $resource = FinanceiroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
