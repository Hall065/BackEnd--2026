<?php

namespace App\Filament\Widgets;

use App\Models\Financeiro;
use App\Models\Pedido;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ConfeccaoStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalPedidos  = Pedido::count();
        $pedidosHoje   = Pedido::whereDate('created_at', today())->count();

        $receitas  = Financeiro::where('tipo', 'receita')->sum('valor');
        $despesas  = Financeiro::where('tipo', 'despesa')->sum('valor');
        $lucro     = $receitas - $despesas;

        $pedidosAbertos = Pedido::whereNotIn('status', ['entregue', 'cancelado'])->count();

        return [
            Stat::make('Total de Pedidos', $totalPedidos)
                ->description("$pedidosHoje novos hoje")
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('info'),

            Stat::make('Pedidos em Aberto', $pedidosAbertos)
                ->description('Pendente + Em produção + Pronto')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Receitas', 'R$ ' . number_format($receitas, 2, ',', '.'))
                ->description('Total de entradas')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->color('success'),

            Stat::make('Despesas', 'R$ ' . number_format($despesas, 2, ',', '.'))
                ->description('Total de saídas')
                ->descriptionIcon('heroicon-o-arrow-trending-down')
                ->color('danger'),

            Stat::make('Lucro / Saldo', 'R$ ' . number_format($lucro, 2, ',', '.'))
                ->description('Receitas − Despesas')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color($lucro >= 0 ? 'success' : 'danger'),
        ];
    }
}
