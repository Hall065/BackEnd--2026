<?php

namespace App\Filament\Resources\Financeiros\Pages;

use App\Filament\Resources\Financeiros\FinanceiroResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFinanceiro extends EditRecord
{
    protected static string $resource = FinanceiroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
