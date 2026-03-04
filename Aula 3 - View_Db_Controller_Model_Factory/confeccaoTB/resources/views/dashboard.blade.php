<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap');

        .dash-root {
            font-family: 'Jost', sans-serif;
            background: #F7F4EF;
            min-height: 100vh;
        }

        .dash-greeting {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 2.6rem;
            font-weight: 300;
            color: #1a1208;
            line-height: 1.1;
            letter-spacing: -0.01em;
        }

        .dash-greeting span {
            color: #B08D57;
        }

        .dash-subtitle {
            font-family: 'Jost', sans-serif;
            font-weight: 300;
            font-size: 0.82rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #8a7a60;
        }

        /* Stat Cards */
        .stat-card {
            background: #fff;
            border: 1px solid #e8e0d0;
            border-radius: 2px;
            padding: 1.8rem 1.6rem 1.4rem;
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .stat-card:hover {
            box-shadow: 0 8px 32px rgba(26,18,8,0.10);
            transform: translateY(-2px);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #B08D57, #d4b07a);
        }

        .stat-icon {
            font-size: 1.6rem;
            margin-bottom: 0.7rem;
            display: block;
        }

        .stat-label {
            font-size: 0.7rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #8a7a60;
            font-weight: 400;
            margin-bottom: 0.35rem;
        }

        .stat-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.1rem;
            font-weight: 600;
            color: #1a1208;
            line-height: 1;
        }

        .stat-change {
            font-size: 0.72rem;
            letter-spacing: 0.05em;
            margin-top: 0.4rem;
            color: #6b8f71;
        }

        .stat-change.down { color: #9f5050; }

        /* Orders Table */
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 400;
            color: #1a1208;
            letter-spacing: 0.01em;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th {
            font-size: 0.68rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #8a7a60;
            font-weight: 400;
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid #e8e0d0;
        }

        .orders-table td {
            padding: 0.9rem 1rem;
            font-size: 0.86rem;
            color: #3a2e1e;
            border-bottom: 1px solid #f0ece4;
            font-weight: 300;
        }

        .orders-table tr:last-child td { border-bottom: none; }

        .orders-table tr:hover td { background: #faf8f4; }

        .badge {
            display: inline-block;
            padding: 0.22rem 0.75rem;
            border-radius: 1px;
            font-size: 0.68rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 400;
        }

        .badge-em-producao  { background: #EEE8D5; color: #7a6830; }
        .badge-concluido    { background: #D5EAD9; color: #3a6b44; }
        .badge-aguardando   { background: #EAD9D5; color: #6b3a3a; }
        .badge-entregue     { background: #D5E0EA; color: #2e4a6b; }

        /* Activity Feed */
        .activity-item {
            display: flex;
            gap: 0.9rem;
            align-items: flex-start;
            padding: 0.85rem 0;
            border-bottom: 1px solid #f0ece4;
        }

        .activity-item:last-child { border-bottom: none; }

        .activity-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #B08D57;
            margin-top: 0.35rem;
            flex-shrink: 0;
        }

        .activity-text {
            font-size: 0.83rem;
            color: #3a2e1e;
            font-weight: 300;
            line-height: 1.45;
        }

        .activity-time {
            font-size: 0.7rem;
            letter-spacing: 0.08em;
            color: #a09080;
            margin-top: 0.18rem;
        }

        /* Quick Actions */
        .action-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.95rem 1.1rem;
            background: #fff;
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
            transform: translateX(3px);
        }

        .action-btn:hover .action-icon { filter: invert(1); }

        .action-label {
            font-size: 0.8rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 400;
        }

        /* Divider gold */
        .gold-divider {
            height: 1px;
            background: linear-gradient(90deg, #B08D57 0%, transparent 100%);
            width: 40px;
            margin-bottom: 1.2rem;
        }

        /* Progress bar */
        .progress-bar-bg {
            background: #e8e0d0;
            border-radius: 1px;
            height: 4px;
            width: 100%;
        }

        .progress-bar-fill {
            height: 4px;
            border-radius: 1px;
            background: linear-gradient(90deg, #B08D57, #d4b07a);
        }

        /* Fade-in animation */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fade-up { animation: fadeUp 0.55s ease both; }
        .delay-1 { animation-delay: 0.07s; }
        .delay-2 { animation-delay: 0.14s; }
        .delay-3 { animation-delay: 0.21s; }
        .delay-4 { animation-delay: 0.28s; }
        .delay-5 { animation-delay: 0.35s; }
        .delay-6 { animation-delay: 0.42s; }
    </style>

    <div class="dash-root py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-8">

            {{-- Header --}}
            <div class="fade-up">
                <p class="dash-subtitle mb-2">Bem-vindo de volta</p>
                <h1 class="dash-greeting">Ateliê <span>em movimento</span>,<br>cada peça conta uma história.</h1>
            </div>

            {{-- Stats Row --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="stat-card fade-up delay-1">
                    <span class="stat-icon">🧵</span>
                    <p class="stat-label">Pedidos Ativos</p>
                    <p class="stat-value">142</p>
                    <p class="stat-change">↑ 12% este mês</p>
                </div>
                <div class="stat-card fade-up delay-2">
                    <span class="stat-icon">✂️</span>
                    <p class="stat-label">Peças em Produção</p>
                    <p class="stat-value">3.840</p>
                    <p class="stat-change">↑ 8% esta semana</p>
                </div>
                <div class="stat-card fade-up delay-3">
                    <span class="stat-icon">📦</span>
                    <p class="stat-label">Entregas do Mês</p>
                    <p class="stat-value">97</p>
                    <p class="stat-change down">↓ 3% vs. anterior</p>
                </div>
                <div class="stat-card fade-up delay-4">
                    <span class="stat-icon">💰</span>
                    <p class="stat-label">Faturamento</p>
                    <p class="stat-value">R$84k</p>
                    <p class="stat-change">↑ 21% este mês</p>
                </div>
            </div>

            {{-- Main Content: Table + Sidebar --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Orders Table --}}
                <div class="lg:col-span-2 bg-white border border-[#e8e0d0] rounded-sm p-6 fade-up delay-3">
                    <div class="gold-divider"></div>
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="section-title">Pedidos Recentes</h2>
                        <a href="#" class="text-[0.7rem] tracking-widest uppercase text-[#B08D57] hover:text-[#1a1208] transition-colors font-[400]">Ver todos →</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Coleção</th>
                                    <th>Qtd.</th>
                                    <th>Status</th>
                                    <th>Prazo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Moda Belle Ltda.</td>
                                    <td>Verão 2025</td>
                                    <td>320 pç</td>
                                    <td><span class="badge badge-em-producao">Em Produção</span></td>
                                    <td>15 Mar</td>
                                </tr>
                                <tr>
                                    <td>Casa Elegante</td>
                                    <td>Linha Casual</td>
                                    <td>180 pç</td>
                                    <td><span class="badge badge-concluido">Concluído</span></td>
                                    <td>10 Mar</td>
                                </tr>
                                <tr>
                                    <td>Armazém Chic</td>
                                    <td>Festa & Gala</td>
                                    <td>95 pç</td>
                                    <td><span class="badge badge-aguardando">Aguardando</span></td>
                                    <td>22 Mar</td>
                                </tr>
                                <tr>
                                    <td>Boutique Florença</td>
                                    <td>Primavera</td>
                                    <td>210 pç</td>
                                    <td><span class="badge badge-entregue">Entregue</span></td>
                                    <td>01 Mar</td>
                                </tr>
                                <tr>
                                    <td>Tendência BR</td>
                                    <td>Inverno 2025</td>
                                    <td>440 pç</td>
                                    <td><span class="badge badge-em-producao">Em Produção</span></td>
                                    <td>30 Mar</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-5">

                    {{-- Meta de produção --}}
                    <div class="bg-white border border-[#e8e0d0] rounded-sm p-6 fade-up delay-4">
                        <div class="gold-divider"></div>
                        <h2 class="section-title mb-4">Meta Mensal</h2>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span style="font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;color:#8a7a60;">Camisas</span>
                                    <span style="font-size:0.8rem;color:#1a1208;">78%</span>
                                </div>
                                <div class="progress-bar-bg"><div class="progress-bar-fill" style="width:78%"></div></div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span style="font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;color:#8a7a60;">Calças</span>
                                    <span style="font-size:0.8rem;color:#1a1208;">54%</span>
                                </div>
                                <div class="progress-bar-bg"><div class="progress-bar-fill" style="width:54%"></div></div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span style="font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;color:#8a7a60;">Vestidos</span>
                                    <span style="font-size:0.8rem;color:#1a1208;">91%</span>
                                </div>
                                <div class="progress-bar-bg"><div class="progress-bar-fill" style="width:91%"></div></div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span style="font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;color:#8a7a60;">Jaquetas</span>
                                    <span style="font-size:0.8rem;color:#1a1208;">36%</span>
                                </div>
                                <div class="progress-bar-bg"><div class="progress-bar-fill" style="width:36%"></div></div>
                            </div>
                        </div>
                    </div>

                    {{-- Atividade recente --}}
                    <div class="bg-white border border-[#e8e0d0] rounded-sm p-6 fade-up delay-5">
                        <div class="gold-divider"></div>
                        <h2 class="section-title mb-3">Atividade</h2>
                        <div>
                            <div class="activity-item">
                                <div class="activity-dot"></div>
                                <div>
                                    <p class="activity-text">Pedido <strong>#1042</strong> enviado para corte.</p>
                                    <p class="activity-time">Hoje, 09:14</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-dot"></div>
                                <div>
                                    <p class="activity-text">Nova solicitação de <strong>Boutique Florença</strong>.</p>
                                    <p class="activity-time">Hoje, 08:47</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-dot"></div>
                                <div>
                                    <p class="activity-text">Entrega confirmada — <strong>Casa Elegante</strong>.</p>
                                    <p class="activity-time">Ontem, 17:30</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-dot"></div>
                                <div>
                                    <p class="activity-text">Estoque de tecido atualizado: +850m de malha.</p>
                                    <p class="activity-time">Ontem, 14:05</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>