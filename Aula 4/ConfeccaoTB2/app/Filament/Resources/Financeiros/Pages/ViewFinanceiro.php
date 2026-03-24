<?php

namespace App\Filament\Resources\Financeiros\Pages;

use App\Filament\Resources\Financeiros\FinanceiroResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFinanceiro extends ViewRecord
{
    protected static string $resource = FinanceiroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
