<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap');

        .dash-root { font-family: 'Jost', sans-serif; background: #F7F4EF; min-height: 100vh; }

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

        .dash-greeting span { color: #B08D57; }

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
            top: 0; left: 0; right: 0;
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

        .orders-table { width: 100%; border-collapse: collapse; }

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
        .orders-table tbody tr:hover td { background: #faf8f4; }

        /* Botão adicionar */
        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Jost', sans-serif;
            font-size: 0.7rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            font-weight: 400;
            color: #F7F4EF;
            background: #1a1208;
            border: 1px solid #1a1208;
            border-radius: 1px;
            padding: 0.55rem 1.1rem;
            text-decoration: none;
            transition: all 0.22s ease;
        }

        .btn-add:hover {
            background: #B08D57;
            border-color: #B08D57;
            color: #fff;
        }

        /* Notificação de sucesso */
        .alert-success {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #f2f8f3;
            border: 1px solid #b8d9be;
            border-left: 3px solid #5a9e6a;
            border-radius: 1px;
            padding: 0.85rem 1.1rem;
            margin-bottom: 1.5rem;
            font-size: 0.82rem;
            color: #2e5c38;
            letter-spacing: 0.03em;
            font-weight: 400;
            animation: fadeUp 0.4s ease both;
        }

        .alert-success-icon {
            font-size: 1rem;
            flex-shrink: 0;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fade-up { animation: fadeUp 0.55s ease both; }
        .delay-1 { animation-delay: 0.07s; }
    </style>

    <div class="dash-root py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            <div class="fade-up">
                <p class="dash-subtitle mb-1">Gestão</p>
                <h1 class="dash-greeting">Clientes <span>cadastrados</span></h1>
            </div>

            {{-- Notificação de sucesso --}}
            @if (session('success'))
                <div class="alert-success fade-up">
                    <span class="alert-success-icon">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="section-card fade-up delay-1">
                <div class="gold-divider"></div>
                <div class="flex items-center justify-between mb-5">
                    <h2 class="section-title">Lista de Clientes</h2>
                    <a href="{{ route('clients.create') }}" class="btn-add">
                        <span>＋</span> Adicionar Cliente
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Endereço</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->cpf }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->telefone }}</td>
                                    <td>{{ $client->endereco }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>