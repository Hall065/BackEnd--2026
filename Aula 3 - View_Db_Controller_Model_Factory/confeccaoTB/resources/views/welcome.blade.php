<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ateliê Confecção - Gestão</title>

        <link rel="icon" type="image/png" href="{{ asset('carretelLogo.png') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Jost', sans-serif;
                background-color: #F7F4EF;
                color: #1a1208;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                position: relative;
                overflow-x: hidden;
            }

            /* Logo */
            .hero-logo {
                width: 80px;
                height: auto;
                margin-bottom: 1.5rem;
                opacity: 0.85;
                animation: fadeUp 0.8s ease both;
            }

            /* Linha dourada no topo da página */
            body::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, #B08D57, #d4b07a, #B08D57);
                z-index: 10;
            }

            /* Navegação de Topo */
            .nav-top {
                display: flex;
                justify-content: flex-end;
                padding: 2rem 3rem;
                gap: 1.5rem;
                position: relative;
                z-index: 10;
            }

            .nav-link {
                font-size: 0.75rem;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                font-weight: 400;
                color: #8a7a60;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .nav-link:hover {
                color: #1a1208;
            }

            /* Área Principal (Hero) */
            .hero-section {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
                padding: 0 2rem;
                margin-top: -4rem; /* Compensar a navbar para centralizar visualmente */
            }

            .hero-subtitle {
                font-weight: 300;
                font-size: 0.85rem;
                letter-spacing: 0.25em;
                text-transform: uppercase;
                color: #8a7a60;
                margin-bottom: 1rem;
                animation: fadeUp 0.8s ease both;
            }

            .hero-title {
                font-family: 'Cormorant Garamond', serif;
                font-style: italic;
                font-size: 4.5rem;
                font-weight: 300;
                color: #1a1208;
                line-height: 1.1;
                margin-bottom: 1.5rem;
                animation: fadeUp 0.8s ease both 0.1s;
            }

            .hero-title span {
                color: #B08D57;
            }

            .gold-divider {
                height: 1px;
                background: linear-gradient(90deg, transparent, #B08D57, transparent);
                width: 120px;
                margin: 0 auto 2rem auto;
                animation: fadeUp 0.8s ease both 0.2s;
            }

            .hero-description {
                font-size: 1.1rem;
                font-weight: 300;
                color: #5c4e3c;
                max-width: 500px;
                line-height: 1.6;
                margin-bottom: 3rem;
                animation: fadeUp 0.8s ease both 0.3s;
            }

            /* Botões */
            .actions-container {
                display: flex;
                gap: 1.5rem;
                justify-content: center;
                animation: fadeUp 0.8s ease both 0.4s;
            }

            .btn-primary, .btn-secondary {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-family: 'Jost', sans-serif;
                font-size: 0.8rem;
                letter-spacing: 0.16em;
                text-transform: uppercase;
                font-weight: 400;
                padding: 0.8rem 2rem;
                border-radius: 1px;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .btn-primary {
                color: #F7F4EF;
                background: #1a1208;
                border: 1px solid #1a1208;
            }

            .btn-primary:hover {
                background: #B08D57;
                border-color: #B08D57;
                color: #fff;
            }

            .btn-secondary {
                color: #1a1208;
                background: transparent;
                border: 1px solid #d4b07a;
            }

            .btn-secondary:hover {
                background: rgba(176, 141, 87, 0.1);
                border-color: #B08D57;
            }

            /* Animação */
            @keyframes fadeUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Responsividade */
            @media (max-width: 600px) {
                .hero-title {
                    font-size: 3rem;
                }
                .actions-container {
                    flex-direction: column;
                    gap: 1rem;
                    width: 100%;
                    max-width: 280px;
                }
                .nav-top {
                    justify-content: center;
                    padding: 1.5rem;
                }
            }
        </style>
    </head>
    <body>

        @if (Route::has('login'))
            <nav class="nav-top">
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Entrar</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link">Registrar</a>
                    @endif
                @endauth
            </nav>
        @endif

        <main class="hero-section">
            <img src="{{ asset('carretelLogo.png') }}" alt="Ateliê Confecção Logo" class="hero-logo">
            <h2 class="hero-subtitle">Sistema de Gestão</h2>
            
            <h1 class="hero-title">Ateliê <span>Confecção</span></h1>
            
            <div class="gold-divider"></div>
            
            <p class="hero-description">
                Administre seus clientes, fornecedores, controle de estoque e pedidos em um ambiente exclusivo e planejado para a alta costura.
            </p>

            <div class="actions-container">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary">Acessar Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary">Fazer Login</a>
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-secondary">Criar Conta</a>
                    @endif
                @endauth
            </div>
        </main>

    </body>
</html>