<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Meu Perfil
        </h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300&family=Jost:wght@300;400;500&display=swap');
        
        .profile-root { font-family: 'Jost', sans-serif; background: #F7F4EF; min-height: calc(100vh - 60px); padding-top: 3rem; }
        .section-card { 
            background: #fff; 
            border: 1px solid #e8e0d0; 
            border-radius: 2px; 
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            color: #1a1208;
            margin-bottom: 0.5rem;
        }
        .section-desc {
            font-size: 0.85rem;
            color: #8a7a60;
            margin-bottom: 1.5rem;
        }
        /* Botões do Perfil */
        button[type="submit"] {
            background: #1a1208 !important;
            font-size: 0.7rem !important;
            letter-spacing: 0.15em !important;
            text-transform: uppercase !important;
            border-radius: 1px !important;
        }
        button[type="submit"]:hover { background: #B08D57 !important; }
    </style>

    <div class="profile-root">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="section-card">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="section-card">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="section-card" style="border-left: 4px solid #fecaca;">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>