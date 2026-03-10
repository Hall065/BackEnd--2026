<x-guest-layout>
    <style>
        /* Estilização do Container de Autenticação */
        .min-h-screen { background-color: #F7F4EF !important; }
        .sm\:max-w-md { 
            background: #fff !important; 
            border: 1px solid #e8e0d0 !important; 
            border-radius: 2px !important;
            box-shadow: 0 10px 25px rgba(26, 18, 8, 0.05) !important;
        }
        
        /* Tipografia e Inputs */
        label { 
            font-family: 'Jost', sans-serif; 
            text-transform: uppercase; 
            letter-spacing: 0.1em; 
            font-size: 0.7rem !important; 
            color: #8a7a60 !important;
        }
        input { 
            border-color: #e8e0d0 !important; 
            border-radius: 1px !important; 
        }
        input:focus { 
            border-color: #B08D57 !important; 
            --tw-ring-color: #B08D57 !important; 
        }

        /* Botão Primário */
        .inline-flex.items-center.px-4.py-2.bg-gray-800 {
            background-color: #1a1208 !important;
            font-family: 'Jost', sans-serif;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-size: 0.75rem;
            transition: all 0.3s;
            border-radius: 1px;
        }
        .inline-flex.items-center.px-4.py-2.bg-gray-800:hover {
            background-color: #B08D57 !important;
        }
        
        .auth-logo-text {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 2.2rem;
            text-align: center;
            margin-bottom: 2rem;
            color: #1a1208;
        }
        .auth-logo-text span { color: #B08D57; }
    </style>

    <div class="auth-logo-text">
        Ateliê <span>Confecção</span>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-[#8a7a60] hover:text-[#1a1208]" href="{{ route('password.request') }}">
                    Esqueceu a senha?
                </a>
            @endif
            <x-primary-button class="ms-3">Entrar</x-primary-button>
        </div>
    </form>
</x-guest-layout>