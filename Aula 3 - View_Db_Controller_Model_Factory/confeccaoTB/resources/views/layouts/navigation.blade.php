<nav x-data="{ open: false }" style="font-family: 'Jost', sans-serif; background: #1a1208; border-bottom: 1px solid #2e2415;">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300&family=Jost:wght@300;400;500&display=swap');

        .nav-root { background: #1a1208; }

        .nav-logo-text {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 1.35rem;
            font-weight: 300;
            color: #F7F4EF;
            letter-spacing: 0.04em;
            text-decoration: none;
            line-height: 1;
        }

        .nav-logo-text span { color: #B08D57; }

        .nav-link-item {
            display: inline-flex;
            align-items: center;
            font-size: 0.7rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            font-weight: 400;
            color: #a89880;
            text-decoration: none;
            padding: 0 0.1rem;
            height: 100%;
            border-bottom: 2px solid transparent;
            transition: color 0.2s ease, border-color 0.2s ease;
        }

        .nav-link-item:hover,
        .nav-item-wrapper:hover .nav-link-item {
            color: #F7F4EF;
            border-bottom-color: #B08D57;
        }

        .nav-link-item.active {
            color: #F7F4EF;
            border-bottom-color: #B08D57;
        }

        /* --- Novo CSS para o Dropdown Hover --- */
        .nav-item-wrapper {
            position: relative;
            height: 100%;
            display: inline-flex;
            align-items: center;
        }

        .nav-hover-menu {
            position: absolute;
            top: 100%; /* Cola exatamente na base da navbar */
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            background: #1a1208;
            border: 1px solid #2e2415;
            border-top: 2px solid #B08D57;
            padding: 0.5rem 0;
            min-width: 170px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 50;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }

        /* O hover no wrapper ativa o menu */
        .nav-item-wrapper:hover .nav-hover-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        /* Área invisível para impedir que o menu suma ao descer o mouse */
        .nav-hover-menu::before {
            content: '';
            position: absolute;
            top: -15px;
            left: 0;
            right: 0;
            height: 15px;
            background: transparent;
        }

        .nav-hover-link {
            display: block;
            padding: 0.7rem 1.2rem;
            font-family: 'Jost', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: #a89880;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s ease;
        }

        .nav-hover-link:hover {
            color: #F7F4EF;
            background: rgba(176, 141, 87, 0.08);
        }
        /* -------------------------------------- */

        .nav-divider {
            width: 1px;
            height: 16px;
            background: #2e2415;
            margin: 0 0.25rem;
        }

        /* Dropdown trigger User */
        .nav-user-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #a89880;
            background: transparent;
            border: 1px solid #2e2415;
            border-radius: 1px;
            padding: 0.4rem 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-user-btn:hover {
            color: #F7F4EF;
            border-color: #B08D57;
        }

        /* Mobile menu */
        .mobile-nav-link {
            display: block;
            font-size: 0.72rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-weight: 400;
            color: #a89880;
            padding: 0.75rem 1.25rem;
            text-decoration: none;
            border-left: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .mobile-nav-link:hover,
        .mobile-nav-link.active {
            color: #F7F4EF;
            border-left-color: #B08D57;
            background: rgba(176, 141, 87, 0.07);
        }

        .nav-gold-dot {
            width: 4px; height: 4px;
            border-radius: 50%;
            background: #B08D57;
            display: inline-block;
            margin: 0 0.6rem;
            opacity: 0.5;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between" style="height: 60px;">

            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="nav-logo-text shrink-0">
                    Ateliê <span>Confecção</span>
                </a>

                <div class="hidden sm:flex items-center h-full" style="gap: 1.75rem;">
                    
                    <a href="{{ route('dashboard') }}"
                       class="nav-link-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>

                    <span class="nav-gold-dot"></span>

                    <div class="nav-item-wrapper">
                        <a href="{{ route('clients.index') }}"
                           class="nav-link-item {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                            Clientes
                        </a>
                        <div class="nav-hover-menu">
                            <a href="{{ route('clients.create') }}" class="nav-hover-link">+ Novo Cliente</a>
                        </div>
                    </div>

                    <div class="nav-item-wrapper">
                        <a href="{{ route('produtos.index') }}"
                           class="nav-link-item {{ request()->routeIs('produtos.*') ? 'active' : '' }}">
                            Produtos
                        </a>
                        <div class="nav-hover-menu">
                            <a href="{{ route('produtos.create') }}" class="nav-hover-link">+ Novo Produto</a>
                        </div>
                    </div>

                    <div class="nav-item-wrapper">
                        <a href="{{ route('fornecedores.index') }}"
                           class="nav-link-item {{ request()->routeIs('fornecedores.*') ? 'active' : '' }}">
                            Fornecedores
                        </a>
                        <div class="nav-hover-menu">
                            <a href="{{ route('fornecedores.create') }}" class="nav-hover-link">+ Novo Fornecedor</a>
                        </div>
                    </div>

                    <div class="nav-item-wrapper">
                        <a href="{{ route('pedidos.index') }}"
                           class="nav-link-item {{ request()->routeIs('pedidos.*') ? 'active' : '' }}">
                            Pedidos
                        </a>
                        <div class="nav-hover-menu">
                            <a href="{{ route('pedidos.create') }}" class="nav-hover-link">+ Novo Pedido</a>
                        </div>
                    </div>

                    <div class="nav-item-wrapper">
                        <a href="{{ route('estoque.index') }}"
                           class="nav-link-item {{ request()->routeIs('estoque.*') ? 'active' : '' }}">
                            Estoque
                        </a>
                        <div class="nav-hover-menu">
                            <a href="{{ route('estoque.create') }}" class="nav-hover-link">+ Adicionar Item</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="hidden sm:flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="nav-user-btn">
                            {{ Auth::user()->name }}
                            <svg style="width:10px;height:10px;fill:#B08D57;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    style="color:#a89880; background:transparent; border:none; padding:0.5rem; cursor:pointer;">
                    <svg style="width:22px;height:22px;" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden"
         style="border-top: 1px solid #2e2415;">

        <div class="py-2">
            <a href="{{ route('dashboard') }}"
               class="mobile-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('clients.index') }}"
               class="mobile-nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                Clientes
            </a>
            <a href="{{ route('produtos.index') }}"
               class="mobile-nav-link {{ request()->routeIs('produtos.*') ? 'active' : '' }}">
                Produtos
            </a>
            <a href="{{ route('fornecedores.index') }}"
               class="mobile-nav-link {{ request()->routeIs('fornecedores.*') ? 'active' : '' }}">
                Fornecedores
            </a>
            <a href="{{ route('pedidos.index') }}"
               class="mobile-nav-link {{ request()->routeIs('pedidos.*') ? 'active' : '' }}">
                Pedidos
            </a>
            <a href="{{ route('estoque.index') }}"
               class="mobile-nav-link {{ request()->routeIs('estoque.*') ? 'active' : '' }}">
                Estoque
            </a>
        </div>

        <div style="border-top: 1px solid #2e2415; padding: 1rem 1.25rem 0.75rem;">
            <p style="font-size:0.8rem;color:#F7F4EF;font-weight:400;letter-spacing:0.05em;">{{ Auth::user()->name }}</p>
            <p style="font-size:0.72rem;color:#a89880;letter-spacing:0.05em;margin-top:0.1rem;">{{ Auth::user()->email }}</p>

            <div style="margin-top:0.75rem; padding-bottom:0.75rem;">
                <a href="{{ route('profile.edit') }}" class="mobile-nav-link" style="padding-left:0;">Profile</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       class="mobile-nav-link"
                       style="padding-left:0;"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>