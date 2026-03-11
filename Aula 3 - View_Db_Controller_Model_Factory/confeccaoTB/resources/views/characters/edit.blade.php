<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Personagem
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
        .dash-input { width: 100%; background: #faf8f4; border: 1px solid #e8e0d0; border-radius: 1px; padding: 0.8rem 1rem; font-family: 'Jost', sans-serif; font-size: 0.9rem; color: #3a2e1e; transition: all 0.25s ease; appearance: none; }
        .dash-input:focus { outline: none; border-color: #B08D57; background: #fff; box-shadow: 0 0 0 1px #B08D57; }

        .btn-submit { display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; font-family: 'Jost', sans-serif; font-size: 0.75rem; letter-spacing: 0.16em; text-transform: uppercase; font-weight: 400; color: #F7F4EF; background: #1a1208; border: 1px solid #1a1208; border-radius: 1px; padding: 0.7rem 1.5rem; cursor: pointer; transition: all 0.25s ease; }
        .btn-submit:hover { background: #B08D57; border-color: #B08D57; color: #fff; }
        .btn-cancel { font-family: 'Jost', sans-serif; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: #8a7a60; text-decoration: none; transition: color 0.2s ease; }
        .btn-cancel:hover { color: #1a1208; text-decoration: underline; text-decoration-color: #B08D57; }

        .hint { font-size: 0.7rem; color: #a89880; font-style: italic; margin-top: 0.4rem; }

        /* Preview da imagem atual */
        .img-preview { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; object-position: top; border: 2px solid #e8e0d0; margin-bottom: 0.75rem; }

        .stars-selector { display: flex; gap: 0.75rem; }
        .stars-option { display: none; }
        .stars-option + label { display: inline-flex; align-items: center; gap: 0.4rem; font-family: 'Jost', sans-serif; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: #8a7a60; border: 1px solid #e8e0d0; border-radius: 1px; padding: 0.5rem 1rem; cursor: pointer; transition: all 0.2s ease; background: #faf8f4; }
        .stars-option:checked + label { border-color: #B08D57; background: #fff; color: #1a1208; }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
        .fade-up { animation: fadeUp 0.55s ease both; }
        .delay-1 { animation-delay: 0.07s; }
    </style>

    <div class="dash-root py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto space-y-6">

            <div class="fade-up">
                <p class="dash-subtitle mb-1">Atualizar Registro</p>
                <h1 class="dash-greeting">Editar <span>{{ $character->name }}</span></h1>
            </div>

            <div class="section-card fade-up delay-1">
                <div class="gold-divider"></div>
                <h2 class="section-title mb-6">Informações do Personagem</h2>

                <form action="{{ route('characters.update', $character->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="dash-label">Nome</label>
                            <input name="name" type="text" class="dash-input" value="{{ old('name', $character->name) }}" required autofocus />
                            @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="dash-label">Constelação</label>
                            <input name="constellation" type="text" class="dash-input" value="{{ old('constellation', $character->constellation) }}" />
                            @error('constellation') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="dash-label">Elemento</label>
                            <select name="element" class="dash-input" required>
                                @foreach(['Geo','Pyro','Hydro','Cryo','Electro','Dendro','Anemo'] as $el)
                                    <option value="{{ $el }}" {{ old('element', $character->element) == $el ? 'selected' : '' }}>{{ $el }}</option>
                                @endforeach
                            </select>
                            @error('element') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="dash-label">Arma</label>
                            <select name="weapon" class="dash-input" required>
                                @foreach(['Sword','Claymore','Polearm','Bow','Catalyst'] as $w)
                                    <option value="{{ $w }}" {{ old('weapon', $character->weapon) == $w ? 'selected' : '' }}>{{ $w }}</option>
                                @endforeach
                            </select>
                            @error('weapon') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="dash-label">Região</label>
                            <select name="region" class="dash-input">
                                @foreach(['Mondstadt','Liyue','Inazuma','Sumeru','Fontaine','Natlan','Snezhnaya'] as $r)
                                    <option value="{{ $r }}" {{ old('region', $character->region) == $r ? 'selected' : '' }}>{{ $r }}</option>
                                @endforeach
                            </select>
                            @error('region') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="dash-label">Raridade</label>
                        <div class="stars-selector">
                            <input type="radio" name="stars" id="stars4" value="4" class="stars-option" {{ old('stars', $character->stars) == 4 ? 'checked' : '' }}>
                            <label for="stars4">★★★★ — 4 estrelas</label>
                            <input type="radio" name="stars" id="stars5" value="5" class="stars-option" {{ old('stars', $character->stars) == 5 ? 'checked' : '' }}>
                            <label for="stars5">★★★★★ — 5 estrelas</label>
                        </div>
                        @error('stars') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="dash-label">Playstyle</label>
                            <input name="playstyle" type="text" class="dash-input" value="{{ old('playstyle', $character->playstyle) }}" />
                            @error('playstyle') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="dash-label">Afiliação</label>
                            <input name="affiliation" type="text" class="dash-input" value="{{ old('affiliation', $character->affiliation) }}" />
                            @error('affiliation') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="dash-label">Mechanics</label>
                        <textarea name="mechanics" class="dash-input" rows="3">{{ old('mechanics', $character->mechanics) }}</textarea>
                        @error('mechanics') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="dash-label">URL da Imagem</label>
                        @if($character->image_url)
                            <img src="{{ $character->image_url }}" alt="{{ $character->name }}" class="img-preview">
                        @endif
                        <input name="image_url" type="url" class="dash-input" value="{{ old('image_url', $character->image_url) }}" />
                        <p class="hint">Deixe em branco para regenerar automaticamente pelo nome do personagem.</p>
                        @error('image_url') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-6 pt-4 border-t border-[#e8e0d0]">
                        <button type="submit" class="btn-submit">Salvar Alterações</button>
                        <a href="{{ route('characters.index') }}" class="btn-cancel">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
