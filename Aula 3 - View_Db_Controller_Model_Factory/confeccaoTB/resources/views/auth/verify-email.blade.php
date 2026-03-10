<x-guest-layout>
    <style>
        .min-h-screen { background-color: #F7F4EF !important; }
        .sm\:max-w-md { background: #fff !important; border: 1px solid #e8e0d0 !important; border-radius: 2px !important; box-shadow: 0 10px 25px rgba(26, 18, 8, 0.05) !important; padding: 2.5rem !important; }
        .sm\:max-w-md img { max-height: 120px !important; margin-bottom: 1rem; display: block; margin-left: auto; margin-right: auto; }
        .auth-logo-text { font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 2.2rem; text-align: center; margin-bottom: 1.5rem; color: #1a1208; }
        .auth-logo-text span { color: #B08D57; }
        .auth-description { font-family: 'Jost', sans-serif; font-weight: 300; font-size: 0.9rem; color: #6b5c47; line-height: 1.6; margin-bottom: 1.5rem; text-align: center; }
        .btn-auth-primary { display: inline-flex; align-items: center; justify-content: center; width: 100%; background-color: #1a1208 !important; color: #F7F4EF !important; font-family: 'Jost', sans-serif; letter-spacing: 0.15em; text-transform: uppercase; font-size: 0.75rem; padding: 0.8rem 1.5rem; border-radius: 1px; border: 1px solid #1a1208; transition: all 0.3s ease; cursor: pointer; }
        .btn-auth-primary:hover { background-color: #B08D57 !important; border-color: #B08D57 !important; }
        .auth-link { font-family: 'Jost', sans-serif; font-size: 0.75rem; color: #8a7a60; text-decoration: none; text-transform: uppercase; letter-spacing: 0.05em; transition: color 0.3s; background: transparent; border: none; cursor: pointer; padding: 0; }
        .auth-link:hover { color: #1a1208; text-decoration: underline; }
    </style>

    <div class="auth-logo-text">Ateliê <span>Confecção</span></div>

    <div class="auth-description">
        {{ __('Obrigado por se inscrever! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se não recebeu o e-mail, teremos prazer em enviar outro.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-center" style="color: #B08D57;">
            {{ __('Um novo link de verificação foi enviado para o endereço de e-mail fornecido.') }}
        </div>
    @endif

    <div class="mt-8 flex flex-col items-center gap-4">
        <form method="POST" action="{{ route('verification.send') }}" style="width: 100%;">
            @csrf
            <button type="submit" class="btn-auth-primary">
                {{ __('Reenviar E-mail de Verificação') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="auth-link">
                {{ __('Sair da conta') }}
            </button>
        </form>
    </div>
</x-guest-layout>