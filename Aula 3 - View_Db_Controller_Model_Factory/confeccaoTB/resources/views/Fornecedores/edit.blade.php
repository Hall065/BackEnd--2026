<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Fornecedor</h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap');
        .dash-root { font-family: 'Jost', sans-serif; background: #F7F4EF; min-height: 100vh; }
        .dash-subtitle { font-family: 'Jost', sans-serif; font-weight: 300; font-size: 0.82rem; letter-spacing: 0.2em; text-transform: uppercase; color: #8a7a60; }
        .dash-greeting { font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 2rem; font-weight: 300; color: #1a1208; line-height: 1.1; }
        .dash-greeting span { color: #B08D57; }
        .section-card { background: #fff; border: 1px solid #e8e0d0; border-radius: 2px; padding: 2.5rem; position: relative; }
        .section-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #B08D57, #d4b07a); }
        .gold-divider { height: 1px; background: linear-gradient(90deg, #B08D57 0%, transparent 100%); width: 40px; margin-bottom: 1.2rem; }
        .section-title { font-family: 'Cormorant Garamond', serif; font-size: 1.4rem; font-weight: 400; color: #1a1208; }
        .dash-label { font-family: 'Jost', sans-serif; font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; color: #8a7a60; margin-bottom: 0.5rem; display: block; }
        .dash-input { width: 100%; background: #faf8f4; border: 1px solid #e8e0d0; padding: 0.8rem; font-size: 0.9rem; transition: all 0.25s; }
        .dash-input:focus { outline: none; border-color: #B08D57; background: #fff; }
        .btn-submit { background: #1a1208; color: #F7F4EF; padding: 0.7rem 1.5rem; text-transform: uppercase; letter-spacing: 0.16em; font-size: 0.75rem; border: none; cursor: pointer; }
        .btn-submit:hover { background: #B08D57; }
        .btn-cancel { font-size: 0.75rem; text-transform: uppercase; color: #8a7a60; text-decoration: none; }
    </style>

    <div class="dash-root py-10 px-4">
        <div class="max-w-4xl mx-auto space-y-6">
            <div class="fade-up">
                <p class="dash-subtitle mb-1">Atualizar Parceiro</p>
                <h1 class="dash-greeting">Editar <span>Fornecedor</span></h1>
            </div>

            <div class="section-card">
                <div class="gold-divider"></div>
                <form action="{{ route('fornecedores.update', $fornecedore->id) }}" method="POST" class="space-y-6">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="dash-label">Nome/Razão Social</label>
                            <input name="nome" type="text" class="dash-input" value="{{ old('nome', $fornecedore->nome) }}" required />
                        </div>
                        <div>
                            <label class="dash-label">CNPJ</label>
                            <input name="cnpj" type="text" class="dash-input" value="{{ old('cnpj', $fornecedore->cnpj) }}" required />
                        </div>
                        <div>
                            <label class="dash-label">Telefone</label>
                            <input name="telefone" type="text" class="dash-input" value="{{ old('telefone', $fornecedore->telefone) }}" required />
                        </div>
                        <div>
                            <label class="dash-label">E-mail Corporativo</label>
                            <input name="email" type="email" class="dash-input" value="{{ old('email', $fornecedore->email) }}" required />
                        </div>
                    </div>
                    <div class="flex items-center gap-6 pt-4 border-t border-[#e8e0d0]">
                        <button type="submit" class="btn-submit">Salvar Alterações</button>
                        <a href="{{ route('fornecedores.index') }}" class="btn-cancel">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>