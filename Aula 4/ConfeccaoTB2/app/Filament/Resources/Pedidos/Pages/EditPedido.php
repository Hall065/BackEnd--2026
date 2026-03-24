<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\Pedidos\PedidoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPedido extends EditRecord
{
    protected static string $resource = PedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    // Recalcula o total sempre que o pedido for editado e salvo
    protected function afterSave(): void
    {
        $pedido = $this->record;

        $total = $pedido->items->sum(
            fn ($item) => $item->quantidade * $item->preco_unitario
        );

        $pedido->update(['total' => $total]);
    }
}
