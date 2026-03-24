<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\Pedidos\PedidoResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePedido extends CreateRecord
{
    protected static string $resource = PedidoResource::class;

    // Recalcula o total após salvar, pois o Repeater persiste os itens depois do pedido
    protected function afterCreate(): void
    {
        $pedido = $this->record;

        $total = $pedido->items->sum(
            fn ($item) => $item->quantidade * $item->preco_unitario
        );

        $pedido->update(['total' => $total]);
    }
}
