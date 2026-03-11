<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap');
        .dash-root { font-family: 'Jost', sans-serif; background: #F7F4EF; min-height: 100vh; }
        .dash-subtitle { font-family: 'Jost', sans-serif; font-weight: 300; font-size: 0.82rem; letter-spacing: 0.2em; text-transform: uppercase; color: #8a7a60; }
        .dash-greeting { font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 2rem; font-weight: 300; color: #1a1208; line-height: 1.1; }
        .dash-greeting span { color: #B08D57; }
        .section-card { background: #fff; border: 1px solid #e8e0d0; border-radius: 2px; padding: 2rem; position: relative; }
        .section-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #B08D57, #d4b07a); }
        .gold-divider { height: 1px; background: linear-gradient(90deg, #B08D57 0%, transparent 100%); width: 40px; margin-bottom: 1.2rem; }
        .section-title { font-family: 'Cormorant Garamond', serif; font-size: 1.4rem; font-weight: 400; color: #1a1208; }
        .btn-add { background: #1a1208; color: #F7F4EF; padding: 0.6rem 1.2rem; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.16em; text-decoration: none; transition: 0.25s; }
        .btn-add:hover { background: #B08D57; }
        .orders-table { width: 100%; border-collapse: collapse; }
        .orders-table th { font-size: 0.68rem; letter-spacing: 0.18em; text-transform: uppercase; color: #8a7a60; padding: 0.75rem 1rem; text-align: left; border-bottom: 1px solid #e8e0d0; font-weight: 400; }
        .orders-table td { padding: 0.9rem 1rem; font-size: 0.86rem; color: #3a2e1e; border-bottom: 1px solid #f0ece4; font-weight: 300; }
        
        .action-link { font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; text-decoration: none; font-weight: 500; margin-right: 0.75rem; }
        .action-edit { color: #B08D57; }
        .action-delete { color: #a89880; background: none; border: none; cursor: pointer; }
        .action-delete:hover { color: #4a1c1c; }
        
        .btn-danger-custom { background: #4a1c1c; border: 1px solid #4a1c1c; color: #fff; padding: 0.6rem 1.2rem; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.16em; cursor: pointer; transition: 0.25s; }
        .btn-danger-custom:hover { background: #1a1208; }
        .btn-cancel-modal { font-family: 'Jost', sans-serif; font-size: 0.75rem; text-transform: uppercase; color: #8a7a60; background: none; border: none; cursor: pointer; }
        .btn-cancel-modal:hover { color: #1a1208; text-decoration: underline; text-decoration-color: #B08D57; }
        
        /* Badges de Status (Opcional: Ajuste as cores conforme o seu design atual) */
        .badge { display: inline-block; padding: 0.22rem 0.75rem; border-radius: 1px; font-size: 0.68rem; letter-spacing: 0.12em; text-transform: uppercase; font-weight: 400; }
        .badge-em-producao { background: #e3d5ca; color: #5a4030; }
        .badge-concluido { background: #d5ead9; color: #3a6b44; }
        .badge-aguardando { background: #eadad5; color: #6b4c3a; }
        .badge-entregue { background: #d5e0ea; color: #2e4a6b; }
        .badge-default { background: #f0ece4; color: #8a7a60; }

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
    </style>

    <div class="dash-root py-10 px-4">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="fade-up">
                <p class="dash-subtitle mb-1">Logística e Produção</p>
                <h1 class="dash-greeting">Nossos <span>Pedidos</span></h1>
            </div>

            @if(session('success'))
                <div id="flashSuccess" class="flash-success fade-up">
                    <svg class="flash-icon" fill="none" viewBox="0 0 24 24" stroke="#B08D57" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="flash-text">{{ session('success') }}</span>
                    <button class="flash-close" onclick="dispensarFlash()" title="Fechar">&times;</button>
                </div>
            @endif


            <div class="section-card">
                <div class="gold-divider"></div>
                <div class="flex items-center justify-between mb-5">
                    <h2 class="section-title">Lista de Pedidos</h2>
                    <a href="{{ route('pedidos.create') }}" class="btn-add">+ Novo Pedido</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Cliente</th>
                                <th>Status</th>
                                <th>Valor</th>
                                <th style="text-align: right;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->id }}</td>
                                    <td>{{ $pedido->client_id }}</td>
                                    <td>
                                        @php $s = strtolower($pedido->status); @endphp
                                        @if($s === 'em producao' || $s === 'em produção')
                                            <span class="badge badge-em-producao">{{ ucfirst($pedido->status) }}</span>
                                        @elseif($s === 'concluido' || $s === 'concluído')
                                            <span class="badge badge-concluido">{{ ucfirst($pedido->status) }}</span>
                                        @elseif($s === 'aguardando')
                                            <span class="badge badge-aguardando">{{ ucfirst($pedido->status) }}</span>
                                        @elseif($s === 'entregue')
                                            <span class="badge badge-entregue">{{ ucfirst($pedido->status) }}</span>
                                        @else
                                            <span class="badge badge-default">{{ ucfirst($pedido->status) }}</span>
                                        @endif
                                    </td>
                                    <td>R$ {{ number_format($pedido->valor, 2, ',', '.') }}</td>
                                    <td style="text-align: right;">
                                        <a href="{{ route('pedidos.edit', $pedido->id) }}" class="action-link action-edit">Editar</a>
                                        <button type="button" class="action-link action-delete"
                                            onclick="abrirModalExclusao('{{ route('pedidos.destroy', $pedido->id) }}', '{{ $pedido->id }}')">
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

    <div id="modalConfirmacao" class="fixed inset-0 bg-[#1a1208]/80 backdrop-blur-sm hidden justify-center items-center z-50 p-4">
        <div class="section-card max-w-md w-full text-center">
            <div class="gold-divider mx-auto"></div>
            <h3 class="dash-greeting mb-4" style="font-size: 1.5rem;">Confirmar <span>Remoção</span></h3>
            <p class="dash-subtitle mb-8" style="font-size: 0.7rem; color: #8a7a60;">
                Deseja cancelar e remover o <strong style="color: #1a1208;">Pedido #<span id="nomeItemModal"></span></strong>?
            </p>
            <div class="flex justify-center gap-6">
                <button onclick="fecharModalExclusao()" class="btn-cancel-modal">Manter</button>
                <form id="formExclusao" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger-custom">Confirmar Exclusão</button>
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
        setTimeout(dispensarFlash, 5000);

function abrirModalExclusao(url, idPedido) {
            document.getElementById('formExclusao').action = url;
            document.getElementById('nomeItemModal').innerText = idPedido;
            document.getElementById('modalConfirmacao').classList.replace('hidden', 'flex');
        }
        function fecharModalExclusao() {
            document.getElementById('modalConfirmacao').classList.replace('flex', 'hidden');
        }
    </script>
</x-app-layout>