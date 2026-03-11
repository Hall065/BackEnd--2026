<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Personagens
        </h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap');

        .dash-root { font-family: 'Jost', sans-serif; background: #F7F4EF; min-height: 100vh; }
        .dash-subtitle { font-family: 'Jost', sans-serif; font-weight: 300; font-size: 0.82rem; letter-spacing: 0.2em; text-transform: uppercase; color: #8a7a60; }
        .dash-greeting { font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 2rem; font-weight: 300; color: #1a1208; line-height: 1.1; }
        .dash-greeting span { color: #B08D57; }

        .page-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .btn-add {
            display: inline-flex; align-items: center; gap: 0.5rem;
            font-family: 'Jost', sans-serif; font-size: 0.75rem; letter-spacing: 0.16em;
            text-transform: uppercase; font-weight: 400; color: #F7F4EF;
            background: #1a1208; border: 1px solid #1a1208; border-radius: 1px;
            padding: 0.6rem 1.2rem; text-decoration: none; transition: all 0.25s ease;
        }
        .btn-add:hover { background: #B08D57; border-color: #B08D57; color: #fff; }

        /* Cards grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 28px;
            justify-content: flex-start;
        }
        /* Responsividade para telas maiores */
        @media (min-width: 768px) {
            .cards-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (min-width: 1024px) {
            .cards-grid { grid-template-columns: repeat(3, 1fr); }
        }

        @media (min-width: 1280px) {
            .cards-grid { grid-template-columns: repeat(4, 1fr); } /* 4 cards por linha em telas grandes */
        }

        /* Rarity section headers */
        .rarity-section { margin-bottom: 56px; }

        .rarity-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(26,18,8,0.08);
        }

        .rarity-badge {
            font-family: 'Jost', sans-serif;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 50px;
        }
        .rarity-5 .rarity-badge { background: rgba(200,168,75,0.12); border: 1px solid rgba(200,168,75,0.35); color: #8a6010; }
        .rarity-4 .rarity-badge { background: rgba(150,100,200,0.10); border: 1px solid rgba(150,100,200,0.28); color: #6030a0; }

        .rarity-count {
            font-family: 'Jost', sans-serif;
            font-size: 11px;
            color: #a89880;
            letter-spacing: 0.1em;
        }

        /* Card wrapper — botões de ação aparecem no hover */
        .card-wrap {
            position: relative;
            display: block;
            width: 100%;
        }

        .card-actions {
            position: absolute;
            bottom: 14px;
            right: 14px;
            display: flex;
            gap: 6px;
            opacity: 0;
            transform: translateY(4px);
            transition: opacity 0.25s ease, transform 0.25s ease;
            z-index: 30;
        }

        .card-wrap:hover .card-actions { opacity: 1; transform: translateY(0); }

        .card-action-btn {
            font-family: 'Jost', sans-serif;
            font-size: 9px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            font-weight: 500;
            padding: 5px 12px;
            border-radius: 2px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            backdrop-filter: blur(8px);
        }
        .btn-edit-card  { background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.25); }
        .btn-edit-card:hover { background: rgba(255,255,255,0.28); }
        .btn-delete-card { background: rgba(80,20,20,0.55); color: #ffaaaa; border: 1px solid rgba(200,80,80,0.35); }
        .btn-delete-card:hover { background: rgba(120,20,20,0.75); }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #a89880;
            font-family: 'Jost', sans-serif;
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        /* Flash */
        .flash-success { display: flex; align-items: center; gap: 0.75rem; background: #fff; border: 1px solid #e8e0d0; border-left: 3px solid #B08D57; border-radius: 2px; padding: 0.9rem 1.2rem; box-shadow: 0 2px 12px rgba(26,18,8,0.07); }
        .flash-text { font-family: 'Jost', sans-serif; font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: #1a1208; }
        .flash-close { margin-left: auto; background: none; border: none; cursor: pointer; color: #a89880; font-size: 1.1rem; line-height: 1; padding: 0 0 0 0.5rem; }
        .flash-close:hover { color: #1a1208; }

        /* Modal */
        .btn-submit { display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; font-family: 'Jost', sans-serif; font-size: 0.75rem; letter-spacing: 0.16em; text-transform: uppercase; font-weight: 400; color: #F7F4EF; background: #1a1208; border: 1px solid #1a1208; border-radius: 1px; padding: 0.7rem 1.5rem; cursor: pointer; transition: all 0.25s ease; }
        .btn-danger-custom { background: #4a1c1c; border: 1px solid #4a1c1c; }
        .btn-danger-custom:hover { background: #1a1208; border-color: #1a1208; }
        .btn-cancel { font-family: 'Jost', sans-serif; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: #8a7a60; text-decoration: none; transition: color 0.2s ease; }
        .btn-cancel:hover { color: #1a1208; }
        .section-card { background: #fff; border: 1px solid #e8e0d0; border-radius: 2px; padding: 2rem; position: relative; }
        .section-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #B08D57, #d4b07a); }
        .gold-divider { height: 1px; background: linear-gradient(90deg, #B08D57 0%, transparent 100%); width: 40px; margin-bottom: 1.2rem; }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
        .fade-up { animation: fadeUp 0.55s ease both; }
        .delay-1 { animation-delay: 0.07s; }
        .delay-2 { animation-delay: 0.14s; }
    </style>

    <div class="dash-root py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-screen-2xl mx-auto space-y-8">

            {{-- Header --}}
            <div class="page-toolbar fade-up">
                <div>
                    <p class="dash-subtitle mb-1">Genshin Impact</p>
                    <h1 class="dash-greeting">Nossos <span>personagens</span></h1>
                </div>
                <a href="{{ route('characters.create') }}" class="btn-add">
                    <span>＋</span> Adicionar Personagem
                </a>
            </div>

            {{-- Flash --}}
            @if(session('success'))
                <div id="flashSuccess" class="flash-success fade-up delay-1">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#B08D57" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="flash-text">{{ session('success') }}</span>
                    <button class="flash-close" onclick="dispensarFlash()">&times;</button>
                </div>
            @endif

            @php
                $chars5 = $characters->where('stars', 5);
                $chars4 = $characters->where('stars', 4);
            @endphp

            {{-- Empty state --}}
            @if($characters->isEmpty())
                <div class="empty-state">Nenhum personagem cadastrado ainda.</div>

            @else

                {{-- 5★ --}}
                @if($chars5->isNotEmpty())
                    <div class="rarity-section fade-up delay-2">
                        <div class="rarity-header">
                            <div class="rarity-badge rarity-5" style="display:inline-block;">★★★★★ — 5 Estrelas</div>
                            <span class="rarity-count">{{ $chars5->count() }} personagens</span>
                        </div>
                        <div class="cards-grid">
                            @foreach($chars5 as $char)
                                <div class="card-wrap">
                                    <x-character-card
                                        :name="$char->name"
                                        :constellation="$char->constellation ?? ''"
                                        :element="$char->element"
                                        :weapon="$char->weapon"
                                        :region="$char->region ?? ''"
                                        :stars="$char->stars"
                                        :playstyle="$char->playstyle ?? ''"
                                        :mechanics="$char->mechanics ?? ''"
                                        :affiliation="$char->affiliation ?? ''"
                                        :image="$char->image_url"
                                    />
                                    <div class="card-actions">
                                        <a href="{{ route('characters.edit', $char->id) }}" class="card-action-btn btn-edit-card">Editar</a>
                                        <button type="button" class="card-action-btn btn-delete-card"
                                            onclick="abrirModal('{{ route('characters.destroy', $char->id) }}', '{{ addslashes($char->name) }}')">
                                            Excluir
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- 4★ --}}
                @if($chars4->isNotEmpty())
                    <div class="rarity-section fade-up delay-2">
                        <div class="rarity-header">
                            <div class="rarity-badge rarity-4" style="display:inline-block;">★★★★ — 4 Estrelas</div>
                            <span class="rarity-count">{{ $chars4->count() }} personagens</span>
                        </div>
                        <div class="cards-grid">
                            @foreach($chars4 as $char)
                                <div class="card-wrap">
                                    <x-character-card
                                        :name="$char->name"
                                        :constellation="$char->constellation ?? ''"
                                        :element="$char->element"
                                        :weapon="$char->weapon"
                                        :region="$char->region ?? ''"
                                        :stars="$char->stars"
                                        :playstyle="$char->playstyle ?? ''"
                                        :mechanics="$char->mechanics ?? ''"
                                        :affiliation="$char->affiliation ?? ''"
                                        :image="$char->image_url"
                                    />
                                    <div class="card-actions">
                                        <a href="{{ route('characters.edit', $char->id) }}" class="card-action-btn btn-edit-card">Editar</a>
                                        <button type="button" class="card-action-btn btn-delete-card"
                                            onclick="abrirModal('{{ route('characters.destroy', $char->id) }}', '{{ addslashes($char->name) }}')">
                                            Excluir
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            @endif

        </div>
    </div>

    {{-- Modal de confirmação --}}
    <div id="modalExclusao" class="fixed inset-0 bg-[#1a1208]/80 backdrop-blur-sm hidden justify-center items-center z-50 p-4">
        <div class="section-card max-w-md w-full fade-up shadow-2xl text-center">
            <div class="gold-divider mx-auto"></div>
            <h3 class="dash-greeting mb-4">Confirmar <span>Remoção</span></h3>
            <p class="font-['Jost'] text-sm text-[#8a7a60] leading-relaxed mb-8 uppercase tracking-widest">
                Deseja realmente remover <strong id="nomeModal" class="text-[#1a1208]"></strong> do sistema?
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button type="button" onclick="fecharModal()" class="btn-cancel py-2">Cancelar</button>
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
        setTimeout(dispensarFlash, 5000);

        function abrirModal(url, nome) {
            document.getElementById('formExclusao').action = url;
            document.getElementById('nomeModal').innerText = nome;
            document.getElementById('modalExclusao').classList.remove('hidden');
            document.getElementById('modalExclusao').classList.add('flex');
        }

        function fecharModal() {
            document.getElementById('modalExclusao').classList.add('hidden');
            document.getElementById('modalExclusao').classList.remove('flex');
        }
    </script>
</x-app-layout>