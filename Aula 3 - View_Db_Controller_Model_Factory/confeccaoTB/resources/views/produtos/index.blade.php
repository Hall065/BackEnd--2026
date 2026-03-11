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
        
        .badge { display: inline-block; padding: 0.22rem 0.75rem; border-radius: 1px; font-size: 0.68rem; letter-spacing: 0.12em; text-transform: uppercase; font-weight: 400; }
        .badge-ativo { background: #d5ead9; color: #3a6b44; }
        .badge-inativo { background: #eadad5; color: #6b4c3a; }

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
                <p class="dash-subtitle mb-1">Catálogo</p>
                <h1 class="dash-greeting">Nossos <span>Produtos</span></h1>
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
                    <h2 class="section-title">Lista de Produtos</h2>
                    <a href="{{ route('produtos.create') }}" class="btn-add">+ Novo Produto</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>ID Fornec.</th>
                                <th>Status</th>
                                <th style="text-align: right;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $produto)
                                <tr>
                                    <td>{{ $produto->id }}</td>
                                    <td><strong>{{ $produto->name }}</strong></td>
                                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                    <td>{{ $produto->fornecedor_id }}</td>
                                    <td>
                                        @if($produto->ativo)
                                            <span class="badge badge-ativo">Ativo</span>
                                        @else
                                            <span class="badge badge-inativo">Inativo</span>
                                        @endif
                                    </td>
                                    <td style="text-align: right;">
                                        <a href="{{ route('produtos.edit', $produto->id) }}" class="action-link action-edit">Editar</a>
                                        <button type="button" class="action-link action-delete"
                                            onclick="abrirModalExclusao('{{ route('produtos.destroy', $produto->id) }}', '{{ $produto->name }}')">
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

    <div id="modalConfirmacao" class="{{ session('modal_exclusao') ? 'flex' : 'hidden' }} fixed inset-0 bg-[#1a1208]/80 backdrop-blur-sm justify-center items-center z-50 p-4">
        <div class="section-card max-w-md w-full text-center">
            <div class="gold-divider mx-auto"></div>
            <h3 class="dash-greeting mb-4" style="font-size: 1.5rem;">Confirmar <span>Remoção</span></h3>
            
            <p class="dash-subtitle mb-2" style="font-size: 0.7rem; color: #8a7a60;">
                Deseja remover o Produto <strong style="color: #1a1208;" id="nomeItemModal">{{ session('produto_nome') }}</strong>?
            </p>

            @if(session('modal_exclusao'))
                <p style="color: #dc2626; font-size: 0.85rem; font-family: 'Jost', sans-serif; margin-bottom: 2rem;">
                    <strong>Atenção:</strong> Este produto possui entradas no Estoque. Confirmar a exclusão apagará também o seu histórico no sistema.
                </p>
            @else
                <div style="height: 1rem;"></div> @endif

            <div class="flex justify-center gap-6 mt-4">
                <button onclick="fecharModalExclusao()" class="btn-cancel-modal">Cancelar</button>
                <form id="formExclusao" method="POST" action="{{ session('modal_exclusao') ? route('produtos.destroy', session('produto_id')) : '' }}">
                    @csrf @method('DELETE')
                    @if(session('modal_exclusao'))
                        <input type="hidden" name="force" value="1">
                    @endif
                    <button type="submit" class="btn-danger-custom">Sim, Excluir</button>
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

function abrirModalExclusao(url, nome) {
            document.getElementById('formExclusao').action = url;
            // Limpa o input hidden 'force' se ele existir para exclusões comuns
            const forceInput = document.querySelector('input[name="force"]');
            if(forceInput) forceInput.remove();
            
            document.getElementById('nomeItemModal').innerText = nome;
            document.getElementById('modalConfirmacao').classList.replace('hidden', 'flex');
        }
        function fecharModalExclusao() {
            document.getElementById('modalConfirmacao').classList.replace('flex', 'hidden');
        }
    </script>
</x-app-layout>