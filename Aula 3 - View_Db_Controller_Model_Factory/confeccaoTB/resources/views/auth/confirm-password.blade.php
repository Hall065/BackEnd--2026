<x-guest-layout>
    <style>
        .min-h-screen { background-color: #F7F4EF !important; }
        .sm\:max-w-md { background: #fff !important; border: 1px solid #e8e0d0 !important; border-radius: 2px !important; box-shadow: 0 10px 25px rgba(26, 18, 8, 0.05) !important; padding: 2.5rem !important; }
        .sm\:max-w-md img { max-height: 120px !important; margin-bottom: 1rem; display: block; margin-left: auto; margin-right: auto; }
        .auth-logo-text { font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 2.2rem; text-align: center; margin-bottom: 1.5rem; color: #1a1208; }
        .auth-logo-text span { color: #B08D57; }
        .auth-description { font-family: 'Jost', sans-serif; font-weight: 300; font-size: 0.9rem; color: #6b5c47; line-height: 1.6; margin-bottom: 1.5rem; text-align: center; }
        label { font-family: 'Jost', sans-serif; text-transform: uppercase; letter-spacing: 0.12em; font-size: 0.7rem !important; color: #8a7a60 !important; margin-bottom: 0.4rem; }
        input { border-color: #e8e0d0 !important; border-radius: 1px !important; font-family: 'Jost', sans-serif; font-weight: 300; color: #1a1208 !important; }
        input:focus { border-color: #B08D57 !important; --tw-ring-color: #B08D57 !important; }
        .btn-auth-primary { display: inline-flex; align-items: center; justify-content: center; width: 100%; background-color: #1a1208 !important; color: #F7F4EF !important; font-family: 'Jost', sans-serif; letter-spacing: 0.15em; text-transform: uppercase; font-size: 0.75rem; padding: 0.8rem 1.5rem; border-radius: 1px; border: 1px solid #1a1208; transition: all 0.3s ease; cursor: pointer; }
        .btn-auth-primary:hover { background-color: #B08D57 !important; border-color: #B08D57 !important; }
    </style>

    <div class="auth-logo-text">Ateliê <span>Confecção</span></div>

    <div class="auth-description">
        {{ __('Esta é uma área segura do sistema. Por favor, confirme sua senha antes de continuar.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-8">
            <button type="submit" class="btn-auth-primary">
                {{ __('Confirmar') }}
            </button>
        </div>
    </form>
</x-guest-layout>