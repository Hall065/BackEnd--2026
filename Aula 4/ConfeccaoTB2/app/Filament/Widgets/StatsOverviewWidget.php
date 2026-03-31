<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Estoque;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $pendentes    = Pedido::where('status', 'Pendente')->count();
        $emProducao   = Pedido::where('status', 'Em Produção')->count();
        $paraEntrega  = Pedido::where('status', 'Para Entrega')->count();
        $faturamento  = Pedido::where('status', 'Finalizado')->sum('valor_total');
        $estoqueBaixo = Estoque::where('quantidade', '<=', 5)->count();
        $totalClientes = Cliente::count();

        return [
            Stat::make('Pedidos Pendentes', $pendentes)
                ->description('Aguardando início')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Em Produção', $emProducao)
                ->description('Em andamento')
                ->descriptionIcon('heroicon-o-cog-6-tooth')
                ->color('info'),

            Stat::make('Para Entrega', $paraEntrega)
                ->description('Prontos para envio')
                ->descriptionIcon('heroicon-o-truck')
                ->color('success'),

            Stat::make('Faturamento Total', 'R$ ' . number_format($faturamento, 2, ',', '.'))
                ->description('Pedidos finalizados')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('success'),

            Stat::make('Estoque Crítico', $estoqueBaixo)
                ->description('Produtos com qtd ≤ 5')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color($estoqueBaixo > 0 ? 'danger' : 'success'),

            Stat::make('Total de Clientes', $totalClientes)
                ->description('Clientes cadastrados')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary'),
        ];
    }
}