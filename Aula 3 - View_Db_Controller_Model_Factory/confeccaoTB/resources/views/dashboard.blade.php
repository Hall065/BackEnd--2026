<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('carretelLogo.png') }}" alt="Logo" style="height: 40px; width: auto;">
                </a>
                <div style="width: 1px; height: 24px; background: #e8e0d0;"></div>
                <h2 style="font-family: 'Jost', sans-serif; font-weight: 300; font-size: 0.85rem; letter-spacing: 0.2em; text-transform: uppercase; color: #8a7a60; margin: 0;">
                    Dashboard
                </h2>
            </div>
            <span style="font-family:'Jost',sans-serif;font-size:0.72rem;letter-spacing:0.15em;text-transform:uppercase;color:#b0a090;">
                {{ now()->translatedFormat('d \d\e F \d\e Y') }}
            </span>
        </div>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap');

        *, *::before, *::after { box-sizing: border-box; }

        .dash-root {
            font-family: 'Jost', sans-serif;
            background: #F7F4EF;
            min-height: 100vh;
        }

        /* ── TYPOGRAPHY ── */
        .dash-greeting {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 2.6rem;
            font-weight: 300;
            color: #1a1208;
            line-height: 1.1;
        }
        .dash-greeting span { color: #B08D57; }
        .dash-subtitle {
            font-family: 'Jost', sans-serif;
            font-weight: 300;
            font-size: 0.78rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #8a7a60;
        }
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-weight: 400;
            color: #1a1208;
        }

        /* ── GOLD ELEMENTS ── */
        .gold-divider {
            height: 1px;
            background: linear-gradient(90deg, #B08D57 0%, transparent 100%);
            width: 40px;
            margin-bottom: 1.2rem;
        }
        .gold-line-v {
            width: 1px;
            background: linear-gradient(180deg, #B08D57 0%, transparent 100%);
            height: 40px;
        }

        /* ── STAT CARDS ── */
        .stat-card {
            background: #fff;
            border: 1px solid #e8e0d0;
            border-radius: 2px;
            padding: 1.6rem 1.5rem 1.2rem;
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.35s ease, transform 0.35s ease;
            cursor: default;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #B08D57, #d4b07a);
        }
        .stat-card::after {
            content: '';
            position: absolute;
            bottom: -40px; right: -40px;
            width: 100px; height: 100px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(176,141,87,0.07) 0%, transparent 70%);
            transition: transform 0.4s ease;
        }
        .stat-card:hover { box-shadow: 0 8px 32px rgba(26,18,8,0.10); transform: translateY(-3px); }
        .stat-card:hover::after { transform: scale(1.6); }

        .stat-icon-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #faf6ef, #f0e8d8);
            border: 1px solid #e8e0d0;
            border-radius: 2px;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }
        .stat-label {
            font-size: 0.68rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #8a7a60;
            margin-bottom: 0.3rem;
        }
        .stat-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.4rem;
            font-weight: 600;
            color: #1a1208;
            line-height: 1;
            transition: color 0.3s;
        }
        .stat-card:hover .stat-value { color: #B08D57; }
        .stat-sub {
            font-size: 0.7rem;
            color: #a09080;
            margin-top: 0.4rem;
            letter-spacing: 0.05em;
        }

        /* ── PANEL ── */
        .panel {
            background: #fff;
            border: 1px solid #e8e0d0;
            border-radius: 2px;
            padding: 1.8rem;
            position: relative;
        }
        .panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #B08D57, #d4b07a);
        }

        /* ── TABLE ── */
        .dash-table { width: 100%; border-collapse: collapse; }
        .dash-table th {
            font-size: 0.65rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #8a7a60;
            padding: 0.6rem 0.9rem;
            text-align: left;
            border-bottom: 1px solid #e8e0d0;
            font-weight: 400;
        }
        .dash-table td {
            padding: 0.85rem 0.9rem;
            font-size: 0.84rem;
            color: #3a2e1e;
            border-bottom: 1px solid #f0ece4;
            font-weight: 300;
        }
        .dash-table tr:last-child td { border-bottom: none; }
        .dash-table tbody tr { transition: background 0.2s; }
        .dash-table tbody tr:hover td { background: #faf8f4; }

        /* ── BADGES ── */
        .badge {
            display: inline-block;
            padding: 0.2rem 0.7rem;
            border-radius: 1px;
            font-size: 0.64rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 400;
        }
        .badge-pendente    { background: #EEE8D5; color: #7a6830; }
        .badge-producao    { background: #E8EED5; color: #4a6830; }
        .badge-concluido   { background: #D5EAD9; color: #3a6b44; }
        .badge-entregue    { background: #D5E0EA; color: #2e4a6b; }
        .badge-cancelado   { background: #EAD5D5; color: #6b3a3a; }
        .badge-default     { background: #F0ECE4; color: #8a7a60; }
        .badge-alerta      { background: #EAD5D5; color: #8a3030; }

        /* ── QUICK ACTIONS ── */
        .action-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.9rem 1rem;
            background: #faf8f4;
            border: 1px solid #e8e0d0;
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none;
            color: #1a1208;
        }
        .action-btn:hover {
            background: #1a1208;
            border-color: #1a1208;
            color: #F7F4EF;
            transform: translateX(4px);
        }
        .action-btn:hover .action-icon { filter: invert(1); }
        .action-label {
            font-size: 0.76rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 400;
        }
        .action-icon { font-size: 1rem; flex-shrink: 0; }

        /* ── FATURAMENTO DESTAQUE ── */
        .fat-card {
            background: linear-gradient(135deg, #1a1208 0%, #2e2010 100%);
            border: 1px solid #3a2e1a;
            border-radius: 2px;
            padding: 1.8rem;
            position: relative;
            overflow: hidden;
        }
        .fat-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at top right, rgba(176,141,87,0.18) 0%, transparent 60%);
        }
        .fat-label { font-size: 0.68rem; letter-spacing: 0.2em; text-transform: uppercase; color: #B08D57; margin-bottom: 0.5rem; }
        .fat-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3rem;
            font-weight: 600;
            color: #F7F4EF;
            line-height: 1;
        }
        .fat-sub { font-size: 0.72rem; color: #8a7a60; margin-top: 0.5rem; letter-spacing: 0.08em; }
        .fat-divider { height: 1px; background: rgba(176,141,87,0.3); margin: 1.2rem 0; }
        .fat-mes-label { font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: #8a7a60; }
        .fat-mes-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 600;
            color: #d4b07a;
        }

        /* ── ACTIVITY FEED ── */
        .activity-item {
            display: flex;
            gap: 0.9rem;
            padding: 0.8rem 0;
            border-bottom: 1px solid #f0ece4;
            align-items: flex-start;
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #B08D57;
            margin-top: 0.45rem;
            flex-shrink: 0;
        }
        .activity-dot.new { background: #6b8f71; }
        .activity-dot.warn { background: #9f5050; }
        .activity-text { font-size: 0.82rem; color: #3a2e1e; font-weight: 300; line-height: 1.45; }
        .activity-text strong { font-weight: 500; }
        .activity-time { font-size: 0.68rem; color: #a09080; margin-top: 0.15rem; letter-spacing: 0.05em; }

        /* ── STATUS DONUTS (CSS only) ── */
        .donut-wrap { display: flex; gap: 1.5rem; flex-wrap: wrap; align-items: center; }
        .donut-item { display: flex; align-items: center; gap: 0.5rem; }
        .donut-dot { width: 10px; height: 10px; border-radius: 1px; flex-shrink: 0; }
        .donut-label { font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase; color: #8a7a60; }
        .donut-count { font-family: 'Cormorant Garamond', serif; font-size: 1.2rem; font-weight: 600; color: #1a1208; }

        /* Barra de status */
        .status-bar-wrap { margin-top: 1rem; }
        .status-bar-bg { background: #f0ece4; border-radius: 1px; height: 6px; width: 100%; overflow: hidden; display: flex; }
        .status-bar-seg { height: 100%; transition: width 0.8s cubic-bezier(.22,.68,0,1.2); }

        /* ── ALERTA ESTOQUE ── */
        .alerta-row { display: flex; align-items: center; gap: 0.75rem; padding: 0.7rem 0; border-bottom: 1px solid #f0ece4; }
        .alerta-row:last-child { border-bottom: none; }
        .alerta-qntd {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: #9f5050;
            min-width: 2rem;
            text-align: right;
        }
        .alerta-nome { font-size: 0.82rem; color: #3a2e1e; font-weight: 300; }
        .alerta-zero { color: #c0392b; }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes countUp {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.55s ease both; }
        .d1 { animation-delay: 0.06s; }
        .d2 { animation-delay: 0.12s; }
        .d3 { animation-delay: 0.18s; }
        .d4 { animation-delay: 0.24s; }
        .d5 { animation-delay: 0.30s; }
        .d6 { animation-delay: 0.36s; }
        .d7 { animation-delay: 0.42s; }
        .d8 { animation-delay: 0.48s; }

        /* ── VER TODOS LINK ── */
        .ver-todos {
            font-size: 0.67rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: #B08D57;
            text-decoration: none;
            font-weight: 400;
            transition: color 0.2s;
        }
        .ver-todos:hover { color: #1a1208; }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 2rem 1rem;
            color: #b0a090;
            font-size: 0.8rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        /* ── TOOLTIP HOVER on stat ── */
        .stat-card [data-tip] { position: relative; }
    </style>

    <div class="dash-root py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-8">

            {{-- ── GREETING ──────────────────────────────────────────────── --}}
            <div class="fade-up">
                <p class="dash-subtitle mb-2">Bem-vindo de volta, {{ Auth::user()->name }}</p>
                <h1 class="dash-greeting">Ateliê <span>em movimento</span>,<br>cada peça conta uma história.</h1>
            </div>

            {{-- ── STAT CARDS ────────────────────────────────────────────── --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">

                <div class="stat-card fade-up d1">
                    <div class="stat-icon-wrap">👥</div>
                    <p class="stat-label">Clientes</p>
                    <p class="stat-value" data-target="{{ $totalClientes }}">{{ $totalClientes }}</p>
                    <p class="stat-sub">cadastrados</p>
                </div>

                <div class="stat-card fade-up d2">
                    <div class="stat-icon-wrap">🏭</div>
                    <p class="stat-label">Fornecedores</p>
                    <p class="stat-value">{{ $totalFornecedores }}</p>
                    <p class="stat-sub">parceiros ativos</p>
                </div>

                <div class="stat-card fade-up d3">
                    <div class="stat-icon-wrap">🧵</div>
                    <p class="stat-label">Pedidos</p>
                    <p class="stat-value">{{ $totalPedidos }}</p>
                    <p class="stat-sub">no sistema</p>
                </div>

                <div class="stat-card fade-up d4">
                    <div class="stat-icon-wrap">✂️</div>
                    <p class="stat-label">Produtos</p>
                    <p class="stat-value">{{ $totalProdutos }}</p>
                    <p class="stat-sub">catalogados</p>
                </div>

                <div class="stat-card fade-up d5 col-span-2 sm:col-span-1">
                    <div class="stat-icon-wrap">📦</div>
                    <p class="stat-label">Estoque Total</p>
                    <p class="stat-value">{{ number_format($totalEstoque) }}</p>
                    <p class="stat-sub">unidades</p>
                </div>

            </div>

            {{-- ── FATURAMENTO + STATUS DOS PEDIDOS ──────────────────────── --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Faturamento --}}
                <div class="fat-card fade-up d3">
                    <div style="position:relative;z-index:1;">
                        <p class="fat-label">Faturamento Total</p>
                        <p class="fat-value">R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</p>
                        <p class="fat-sub">acumulado de todos os pedidos</p>
                        <div class="fat-divider"></div>
                        <p class="fat-mes-label">Este mês</p>
                        <p class="fat-mes-value">R$ {{ number_format($faturamentoMes, 2, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Status dos Pedidos --}}
                <div class="panel lg:col-span-2 fade-up d4">
                    <div class="gold-divider"></div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="section-title">Status dos Pedidos</h2>
                        <a href="{{ route('pedidos.index') }}" class="ver-todos">Ver todos →</a>
                    </div>

                    @php
                        $statusColors = [
                            'pendente'    => '#d4b07a',
                            'em producao' => '#8fbc8f',
                            'em produção' => '#8fbc8f',
                            'concluido'   => '#6b9e75',
                            'concluído'   => '#6b9e75',
                            'entregue'    => '#7a9bbf',
                            'cancelado'   => '#bf7a7a',
                        ];
                        $total = $pedidosPorStatus->sum() ?: 1;
                    @endphp

                    @if($pedidosPorStatus->isEmpty())
                        <div class="empty-state">Nenhum pedido cadastrado ainda</div>
                    @else
                        <div class="donut-wrap mb-4">
                            @foreach($pedidosPorStatus as $status => $qtd)
                                @php $cor = $statusColors[strtolower($status)] ?? '#c0b090'; @endphp
                                <div class="donut-item">
                                    <div class="donut-dot" style="background:{{ $cor }};"></div>
                                    <div>
                                        <div class="donut-count">{{ $qtd }}</div>
                                        <div class="donut-label">{{ ucfirst($status) }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="status-bar-wrap">
                            <div class="status-bar-bg">
                                @foreach($pedidosPorStatus as $status => $qtd)
                                    @php
                                        $cor = $statusColors[strtolower($status)] ?? '#c0b090';
                                        $pct = round(($qtd / $total) * 100, 1);
                                    @endphp
                                    <div class="status-bar-seg" style="width:{{ $pct }}%; background:{{ $cor }};" title="{{ ucfirst($status) }}: {{ $qtd }}"></div>
                                @endforeach
                            </div>
                            <div style="display:flex;justify-content:space-between;margin-top:0.4rem;">
                                <span style="font-size:0.65rem;color:#a09080;letter-spacing:0.08em;">0</span>
                                <span style="font-size:0.65rem;color:#a09080;letter-spacing:0.08em;">{{ $total }} pedidos</span>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

            {{-- ── TABELA PEDIDOS RECENTES + SIDEBAR ─────────────────────── --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Tabela de Pedidos Recentes --}}
                <div class="panel lg:col-span-2 fade-up d4">
                    <div class="gold-divider"></div>
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="section-title">Pedidos Recentes</h2>
                        <a href="{{ route('pedidos.index') }}" class="ver-todos">Ver todos →</a>
                    </div>

                    @if($ultimosPedidos->isEmpty())
                        <div class="empty-state">Nenhum pedido cadastrado ainda</div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="dash-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cliente</th>
                                        <th>Status</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ultimosPedidos as $pedido)
                                        @php
                                            $s = strtolower($pedido->status);
                                            $badgeClass = match(true) {
                                                str_contains($s, 'pendente')   => 'badge-pendente',
                                                str_contains($s, 'produ')      => 'badge-producao',
                                                str_contains($s, 'conclu')     => 'badge-concluido',
                                                str_contains($s, 'entreg')     => 'badge-entregue',
                                                str_contains($s, 'cancel')     => 'badge-cancelado',
                                                default                        => 'badge-default',
                                            };
                                        @endphp
                                        <tr>
                                            <td style="color:#B08D57;font-family:'Cormorant Garamond',serif;font-size:1rem;">#{{ $pedido->id }}</td>
                                            <td>{{ $pedido->client->name ?? '—' }}</td>
                                            <td><span class="badge {{ $badgeClass }}">{{ ucfirst($pedido->status) }}</span></td>
                                            <td>R$ {{ number_format($pedido->valor, 2, ',', '.') }}</td>
                                            <td style="color:#a09080;">{{ $pedido->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                {{-- Sidebar: Atividade Recente --}}
                <div class="space-y-5">

                    {{-- Feed de atividade --}}
                    <div class="panel fade-up d5">
                        <div class="gold-divider"></div>
                        <h2 class="section-title mb-3">Atividade Recente</h2>

                        @php $temAtividade = false; @endphp

                        {{-- Últimos clientes --}}
                        @foreach($ultimosClientes->take(2) as $c)
                            @php $temAtividade = true; @endphp
                            <div class="activity-item">
                                <div class="activity-dot new"></div>
                                <div>
                                    <p class="activity-text">Novo cliente: <strong>{{ $c->name }}</strong></p>
                                    <p class="activity-time">{{ $c->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach

                        {{-- Últimos pedidos --}}
                        @foreach($ultimosPedidos->take(2) as $p)
                            @php $temAtividade = true; @endphp
                            <div class="activity-item">
                                <div class="activity-dot"></div>
                                <div>
                                    <p class="activity-text">Pedido <strong>#{{ $p->id }}</strong> — {{ ucfirst($p->status) }}</p>
                                    <p class="activity-time">{{ $p->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach

                        {{-- Últimas movimentações de estoque --}}
                        @foreach($ultimosEstoques->take(2) as $e)
                            @php $temAtividade = true; @endphp
                            <div class="activity-item">
                                <div class="activity-dot" style="background:#7a9bbf;"></div>
                                <div>
                                    <p class="activity-text">Estoque atualizado: <strong>{{ $e->produto->name ?? 'Produto' }}</strong> → {{ $e->qntd }} un.</p>
                                    <p class="activity-time">{{ $e->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach

                        @if(!$temAtividade)
                            <div class="empty-state" style="padding:1rem 0;">Sem atividade recente</div>
                        @endif
                    </div>

                </div>
            </div>

            {{-- ── LINHA INFERIOR: Clientes + Estoque Baixo + Ações Rápidas ── --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Últimos Clientes --}}
                <div class="panel fade-up d5">
                    <div class="gold-divider"></div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="section-title">Últimos Clientes</h2>
                        <a href="{{ route('clients.index') }}" class="ver-todos">Ver todos →</a>
                    </div>
                    @forelse($ultimosClientes as $c)
                        <div style="display:flex;align-items:center;gap:0.85rem;padding:0.65rem 0;border-bottom:1px solid #f0ece4;">
                            <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#e8e0d0,#d4c8b0);display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:500;color:#8a7a60;flex-shrink:0;letter-spacing:0.05em;">
                                {{ strtoupper(substr($c->name, 0, 2)) }}
                            </div>
                            <div style="min-width:0;">
                                <p style="font-size:0.84rem;color:#1a1208;font-weight:400;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $c->name }}</p>
                                <p style="font-size:0.7rem;color:#a09080;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $c->email }}</p>
                            </div>
                            <div style="margin-left:auto;flex-shrink:0;">
                                <span style="font-size:0.65rem;color:#b0a090;letter-spacing:0.05em;">{{ $c->created_at->format('d/m') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Nenhum cliente ainda</div>
                    @endforelse
                </div>

                {{-- Estoque Baixo / Alertas --}}
                <div class="panel fade-up d6">
                    <div class="gold-divider"></div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="section-title">Alertas de Estoque</h2>
                        <a href="{{ route('estoque.index') }}" class="ver-todos">Ver estoque →</a>
                    </div>

                    @forelse($estoqueBaixo as $item)
                        <div class="alerta-row">
                            <p class="alerta-qntd {{ $item->qntd == 0 ? 'alerta-zero' : '' }}">{{ $item->qntd }}</p>
                            <div>
                                <p class="alerta-nome">{{ $item->produto->name ?? 'Produto #'.$item->produto_id }}</p>
                                @if($item->qntd == 0)
                                    <span class="badge badge-cancelado">Sem estoque</span>
                                @else
                                    <span class="badge badge-pendente">Estoque baixo</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div style="text-align:center;padding:1.5rem 0;">
                            <span style="font-size:1.5rem;">✅</span>
                            <p style="font-size:0.75rem;letter-spacing:0.12em;text-transform:uppercase;color:#6b8f71;margin-top:0.5rem;">Estoque em dia</p>
                        </div>
                    @endforelse
                </div>

                {{-- Acessos Rápidos --}}
                <div class="panel fade-up d7">
                    <div class="gold-divider"></div>
                    <h2 class="section-title mb-4">Ações Rápidas</h2>
                    <div class="space-y-2">
                        <a href="{{ route('pedidos.create') }}" class="action-btn">
                            <span class="action-icon">🧵</span>
                            <span class="action-label">Novo Pedido</span>
                        </a>
                        <a href="{{ route('clients.create') }}" class="action-btn">
                            <span class="action-icon">👤</span>
                            <span class="action-label">Novo Cliente</span>
                        </a>
                        <a href="{{ route('produtos.create') }}" class="action-btn">
                            <span class="action-icon">✂️</span>
                            <span class="action-label">Novo Produto</span>
                        </a>
                        <a href="{{ route('fornecedores.create') }}" class="action-btn">
                            <span class="action-icon">🏭</span>
                            <span class="action-label">Novo Fornecedor</span>
                        </a>
                        <a href="{{ route('estoque.create') }}" class="action-btn">
                            <span class="action-icon">📦</span>
                            <span class="action-label">Atualizar Estoque</span>
                        </a>
                    </div>
                </div>

            </div>

            {{-- ── FORNECEDORES RECENTES ──────────────────────────────────── --}}
            @if($ultimosFornecedores->isNotEmpty())
            <div class="panel fade-up d8">
                <div class="gold-divider"></div>
                <div class="flex items-center justify-between mb-5">
                    <h2 class="section-title">Fornecedores Recentes</h2>
                    <a href="{{ route('fornecedores.index') }}" class="ver-todos">Ver todos →</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach($ultimosFornecedores as $f)
                        <div style="border:1px solid #e8e0d0;border-radius:2px;padding:1rem 1.1rem;background:#faf8f4;transition:box-shadow 0.25s ease;" onmouseover="this.style.boxShadow='0 4px 16px rgba(26,18,8,0.08)'" onmouseout="this.style.boxShadow='none'">
                            <p style="font-size:0.7rem;letter-spacing:0.15em;text-transform:uppercase;color:#B08D57;margin-bottom:0.3rem;">Fornecedor</p>
                            <p style="font-family:'Cormorant Garamond',serif;font-size:1.15rem;color:#1a1208;font-weight:400;">{{ $f->nome }}</p>
                            <p style="font-size:0.76rem;color:#8a7a60;margin-top:0.3rem;">{{ $f->email }}</p>
                            <p style="font-size:0.72rem;color:#b0a090;margin-top:0.2rem;">{{ $f->telefone }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>

</x-app-layout>