<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nossa Confecção
        </h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap');

        /* Root & Typography */
        .dash-root { font-family: 'Jost', sans-serif; background: #F7F4EF; min-height: 100vh; }
        .dash-subtitle { font-family: 'Jost', sans-serif; font-weight: 300; font-size: 0.82rem; letter-spacing: 0.2em; text-transform: uppercase; color: #8a7a60; }
        .dash-greeting { font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 2rem; font-weight: 300; color: #1a1208; line-height: 1.1; }
        .dash-greeting span { color: #B08D57; }

        /* Cards & Dividers */
        .section-card { background: #fff; border: 1px solid #e8e0d0; border-radius: 2px; padding: 2rem; position: relative; }
        .section-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #B08D57, #d4b07a); }
        .gold-divider { height: 1px; background: linear-gradient(90deg, #B08D57 0%, transparent 100%); width: 40px; margin-bottom: 1.2rem; }
        .section-title { font-family: 'Cormorant Garamond', serif; font-size: 1.4rem; font-weight: 400; color: #1a1208; }

        /* Buttons */
        .btn-add, .btn-submit {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            font-family: 'Jost', sans-serif; font-size: 0.75rem; letter-spacing: 0.16em;
            text-transform: uppercase; font-weight: 400; color: #F7F4EF;
            background: #1a1208; border: 1px solid #1a1208; border-radius: 1px;
            padding: 0.6rem 1.2rem; text-decoration: none; transition: all 0.25s ease; cursor: pointer;
        }
        .btn-add:hover { background: #B08D57; border-color: #B08D57; color: #fff; }
        
        .btn-danger-custom { background: #4a1c1c; border: 1px solid #4a1c1c; }
        .btn-danger-custom:hover { background: #1a1208; border-color: #1a1208; }

        .btn-cancel {
            font-family: 'Jost', sans-serif; font-size: 0.75rem; letter-spacing: 0.1em;
            text-transform: uppercase; color: #8a7a60; text-decoration: none;
            transition: color 0.2s ease;
        }
        .btn-cancel:hover { color: #1a1208; text-decoration: underline; text-decoration-color: #B08D57; }

        /* Table Styles */
        .orders-table { width: 100%; border-collapse: collapse; }
        .orders-table th { font-size: 0.68rem; letter-spacing: 0.18em; text-transform: uppercase; color: #8a7a60; font-weight: 400; padding: 0.75rem 1rem; text-align: left; border-bottom: 1px solid #e8e0d0; }
        .orders-table td { padding: 0.9rem 1rem; font-size: 0.86rem; color: #3a2e1e; border-bottom: 1px solid #f0ece4; font-weight: 300; }
        .orders-table tbody tr:hover td { background: #faf8f4; }

        .action-link { font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; text-decoration: none; font-weight: 500; transition: color 0.2s ease; margin-right: 0.75rem; }
        .action-edit { color: #B08D57; }
        .action-delete { color: #a89880; background: none; border: none; cursor: pointer; padding: 0; }
        .action-delete:hover { color: #4a1c1c; }

        /* Flash Notification */
        .flash-success {
            display: flex; align-items: center; gap: 0.75rem;
            background: #fff; border: 1px solid #e8e0d0; border-left: 3px solid #B08D57;
            border-radius: 2px; padding: 0.9rem 1.2rem;
            box-shadow: 0 2px 12px rgba(26,18,8,0.07);
            transition: opacity 0.5s ease;
        }
        .flash-icon { flex-shrink: 0; width: 18px; height: 18px; }
        .flash-text { font-family: 'Jost', sans-serif; font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: #1a1208; font-weight: 400; }
        .flash-close { margin-left: auto; background: none; border: none; cursor: pointer; color: #a89880; font-size: 1.1rem; line-height: 1; padding: 0 0 0 0.5rem; transition: color 0.2s ease; }
        .flash-close:hover { color: #1a1208; }

        /* Animations */
        @keyframes fadeUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
        .fade-up { animation: fadeUp 0.55s ease both; }
        .delay-1 { animation-delay: 0.07s; }
        .delay-2 { animation-delay: 0.14s; }
    </style>

    <div class="dash-root py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            <div class="fade-up">
                <p class="dash-subtitle mb-1">CRM</p>
                <h1 class="dash-greeting">Nossos <span>clientes</span></h1>
            </div>

            @if(session('success'))
                <div id="flashSuccess" class="flash-success fade-up delay-1">
                    <svg class="flash-icon" fill="none" viewBox="0 0 24 24" stroke="#B08D57" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="flash-text">{{ session('success') }}</span>
                    <button class="flash-close" onclick="dispensarFlash()" title="Fechar">&times;</button>
                </div>
            @endif

            <div class="section-card fade-up delay-2">
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
                                <th style="text-align: right;">Ações</th>
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
                                    <td style="text-align: right; min-width: 130px;">
                                        <a href="{{ route('clients.edit', $client->id) }}" class="action-link action-edit">Editar</a>
                                        <button type="button" class="action-link action-delete"
                                            onclick="abrirModalExclusao('{{ route('clients.destroy', $client->id) }}', '{{ addslashes($client->name) }}')">
                                            Excluir
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if(session('modal_exclusao'))
        <div class="fixed inset-0 bg-[#1a1208]/80 backdrop-blur-sm flex justify-center items-center z-50 p-4">
            <div class="section-card max-w-md w-full fade-up shadow-2xl text-center">
                <div class="gold-divider mx-auto"></div>
                <h3 class="dash-greeting mb-4">Atenção <span>Restrita</span></h3>
                <p class="font-['Jost'] text-sm text-[#8a7a60] leading-relaxed mb-8 uppercase tracking-widest">
                    O cliente <strong>{{ session('cliente_nome') }}</strong> possui registros de pedidos ativos. 
                    <br><br>
                    <span class="text-[#1a1208]">A exclusão forçada removerá permanentemente todos os dados vinculados.</span>
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('clients.index') }}" class="btn-cancel py-2">Abortar</a>
                    <form action="{{ route('clients.destroy', session('cliente_id')) }}" method="POST">
                        @csrf @method('DELETE')
                        <input type="hidden" name="force" value="1">
                        <button type="submit" class="btn-submit btn-danger-custom">Confirmar Exclusão Total</button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <div id="modalConfirmacao" class="fixed inset-0 bg-[#1a1208]/80 backdrop-blur-sm hidden justify-center items-center z-50 p-4">
        <div class="section-card max-w-md w-full fade-up shadow-2xl text-center">
            <div class="gold-divider mx-auto"></div>
            <h3 class="dash-greeting mb-4">Confirmar <span>Remoção</span></h3>
            <p class="font-['Jost'] text-sm text-[#8a7a60] leading-relaxed mb-8 uppercase tracking-widest">
                Deseja realmente remover <strong id="nomeClienteModal" class="text-[#1a1208]"></strong> do sistema?
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button type="button" onclick="fecharModalExclusao()" class="btn-cancel py-2">Manter Registro</button>
                <form id="formExclusao" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-submit btn-danger-custom">Confirmar Exclusão</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function dispensarFlash() {
            const el = document.getElementById('flashSuccess');
            if (!el) return;
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        }

        // Auto-dispensar após 5 segundos
        setTimeout(dispensarFlash, 5000);

        function abrirModalExclusao(url, nome) {
            document.getElementById('formExclusao').action = url;
            document.getElementById('nomeClienteModal').innerText = nome;
            document.getElementById('modalConfirmacao').classList.remove('hidden');
            document.getElementById('modalConfirmacao').classList.add('flex');
        }

        function fecharModalExclusao() {
            document.getElementById('modalConfirmacao').classList.add('hidden');
            document.getElementById('modalConfirmacao').classList.remove('flex');
        }
    </script>
</x-app-layout>