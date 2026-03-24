<?php

namespace App\Filament\Resources\Financeiros\Pages;

use App\Filament\Resources\Financeiros\FinanceiroResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFinanceiro extends CreateRecord
{
    protected static string $resource = FinanceiroResource::class;
}
