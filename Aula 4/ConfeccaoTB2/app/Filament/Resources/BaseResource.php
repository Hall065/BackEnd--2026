<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;

class BaseResource extends Resource
{
    /**
     * Permite acesso para Admin e User.
     * Sobrescreva nas subclasses para restringir mais.
     */
    public static function canAccess(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();

        return $user?->hasAnyRole(['Admin', 'User']) ?? false;
    }
}