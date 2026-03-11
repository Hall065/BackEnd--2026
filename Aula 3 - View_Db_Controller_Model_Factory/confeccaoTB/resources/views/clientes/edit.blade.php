<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Cliente
        </h2>
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

        .dash-label { font-family: 'Jost', sans-serif; font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; color: #8a7a60; font-weight: 400; margin-bottom: 0.5rem; display: block; }
        .dash-input { width: 100%; background: #faf8f4; border: 1px solid #e8e0d0; border-radius: 1px; padding: 0.8rem 1rem; font-family: 'Jost', sans-serif; font-size: 0.9rem; color: #3a2e1e; transition: all 0.25s ease; }
        .dash-input:focus { outline: none; border-color: #B08D57; background: #fff; box-shadow: 0 0 0 1px #B08D57; }

        .btn-submit { display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; font-family: 'Jost', sans-serif; font-size: 0.75rem; letter-spacing: 0.16em; text-transform: uppercase; font-weight: 400; color: #F7F4EF; background: #1a1208; border: 1px solid #1a1208; border-radius: 1px; padding: 0.7rem 1.5rem; cursor: pointer; transition: all 0.25s ease; }
        .btn-submit:hover { background: #B08D57; border-color: #B08D57; color: #fff; }
        .btn-cancel { font-family: 'Jost', sans-serif; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: #8a7a60; text-decoration: none; transition: color 0.2s ease; }
        .btn-cancel:hover { color: #1a1208; text-decoration: underline; text-decoration-color: #B08D57; }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
        .fade-up { animation: fadeUp 0.55s ease both; }
        .delay-1 { animation-delay: 0.07s; }
    </style>

    <div class="dash-root py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto space-y-6">

            <div class="fade-up">
                <p class="dash-subtitle mb-1">Atualizar Registro</p>
                <h1 class="dash-greeting">Editar <span>cliente</span></h1>
            </div>

            <div class="section-card fade-up delay-1">
                <div class="gold-divider"></div>
                <h2 class="section-title mb-6">Informações Cadastrais</h2>

                <form action="{{ route('clients.update', $client->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nome" class="dash-label">Nome Completo</label>
                        <input id="nome" name="name" type="text" class="dash-input" value="{{ old('name', $client->name) }}" required autofocus />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="cpf" class="dash-label">CPF</label>
                            <input id="cpf" name="cpf" type="text" class="dash-input" value="{{ old('cpf', $client->cpf) }}" required />
                            @error('cpf')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="telefone" class="dash-label">Telefone</label>
                            <input id="telefone" name="telefone" type="text" class="dash-input" value="{{ old('telefone', $client->telefone) }}" required />
                            @error('telefone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="email" class="dash-label">E-mail</label>
                        <input id="email" name="email" type="email" class="dash-input" value="{{ old('email', $client->email) }}" required />
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="endereco" class="dash-label">Endereço</label>
                        <textarea id="endereco" name="endereco" class="dash-input" rows="3">{{ old('endereco', $client->endereco) }}</textarea>
                        @error('endereco')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-6 pt-4 border-t border-[#e8e0d0]">
                        <button type="submit" class="btn-submit">
                            Salvar Alterações
                        </button>
                        <a href="{{ route('clients.index') }}" class="btn-cancel">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>