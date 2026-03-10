<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Estoque
        </h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap');

        .dash-root {
            font-family: 'Jost', sans-serif;
            background: #F7F4EF;
            min-height: 100vh;
        }

        .dash-subtitle {
            font-family: 'Jost', sans-serif;
            font-weight: 300;
            font-size: 0.82rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #8a7a60;
        }

        .dash-greeting {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 2rem;
            font-weight: 300;
            color: #1a1208;
            line-height: 1.1;
        }

        .dash-greeting span {
            color: #B08D57;
        }

        .section-card {
            background: #fff;
            border: 1px solid #e8e0d0;
            border-radius: 2px;
            padding: 2rem;
            position: relative;
        }

        .section-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #B08D57, #d4b07a);
        }

        .gold-divider {
            height: 1px;
            background: linear-gradient(90deg, #B08D57 0%, transparent 100%);
            width: 40px;
            margin-bottom: 1.2rem;
        }

        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 400;
            color: #1a1208;
        }

        /* Botão Adicionar Item */
        .btn-add {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-family: 'Jost', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            font-weight: 400;
            color: #F7F4EF;
            background: #1a1208;
            border: 1px solid #1a1208;
            border-radius: 1px;
            padding: 0.6rem 1.2rem;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .btn-add:hover {
            background: #B08D57;
            border-color: #B08D57;
            color: #fff;
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

        .orders-table tr:last-child td {
            border-bottom: none;
        }

        .orders-table tbody tr:hover td {
            background: #faf8f4;
        }

        .badge {
            display: inline-block;
            padding: 0.22rem 0.75rem;
            border-radius: 1px;
            font-size: 0.68rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 400;
        }

        .badge-low {
            background: #EAD9D5;
            color: #6b3a3a;
        }

        .badge-ok {
            background: #D5EAD9;
            color: #3a6b44;
        }

        .badge-high {
            background: #D5E0EA;
            color: #2e4a6b;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 0.55s ease both;
        }

        .delay-1 {
            animation-delay: 0.07s;
        }
    </style>

    <div class="dash-root py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            <div class="fade-up">
                <p class="dash-subtitle mb-1">Controle</p>
                <h1 class="dash-greeting">Estoque <span>de produtos</span></h1>
            </div>

            <div class="section-card fade-up delay-1">
                <div class="gold-divider"></div>
                <div class="flex items-center justify-between mb-5">
                    <h2 class="section-title">Inventário</h2>
                    <a href="{{ route('estoque.create') }}" class="btn-add">
                        <span>＋</span> Adicionar Item
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome do Produto</th>
                                <th>Produto ID</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estoques as $estoque)
                                <tr>
                                    <td>{{ $estoque->id }}</td>
                                    <td>{{ optional($estoque->produto)->name }}</td>
                                    <td>{{ $estoque->produto_id }}</td>
                                    <td>
                                        @php $q = $estoque->qntd; @endphp
                                        @if($q <= 10)
                                            <span class="badge badge-low">{{ $q }} — Baixo</span>
                                        @elseif($q <= 100)
                                            <span class="badge badge-ok">{{ $q }}</span>
                                        @else
                                            <span class="badge badge-high">{{ $q }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>