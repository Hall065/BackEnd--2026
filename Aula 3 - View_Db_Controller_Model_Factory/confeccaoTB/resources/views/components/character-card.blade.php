{{--
    Character Card Component
    Usage:
    <x-character-card
        name="Ningguang"
        constellation="Eclipsing Star"
        element="Geo"
        weapon="Catalyst"
        region="Liyue"
        playstyle="Burst DPS / Support"
        mechanics="Uses Jade Screen to shield and boost damage."
        affiliation="Liyue Qixing"
        :stars="4"
        image="https://example.com/ningguang.png"
    />

    Elementos suportados: Geo, Pyro, Hydro, Cryo, Electro, Dendro, Anemo
--}}

@props([
    'name'          => 'Character Name',
    'constellation' => 'Constellation',
    'element'       => 'Geo',
    'weapon'        => 'Weapon',
    'region'        => 'Region',
    'playstyle'     => 'Playstyle description',
    'mechanics'     => 'Mechanics description',
    'affiliation'   => 'Affiliation',
    'stars'         => 4,
    'image'         => null,
])

@php
    // ID único para o card
    $uid = 'gc-' . substr(md5(uniqid($name, true)), 0, 8);

    $palette = [
        'Geo'     => ['primary' => '#f0b22a', 'glow' => 'rgba(240,178,42,0.40)',  'glow22' => 'rgba(240,178,42,0.22)', 'glow30' => 'rgba(240,178,42,0.30)', 'glow40' => 'rgba(240,178,42,0.18)', 'bg_from' => '#2a1f00', 'bg_to' => '#1a1400', 'badge_bg' => 'rgba(240,178,42,0.12)'],
        'Pyro'    => ['primary' => '#ff6640', 'glow' => 'rgba(255,102,64,0.40)',  'glow22' => 'rgba(255,102,64,0.22)', 'glow30' => 'rgba(255,102,64,0.30)', 'glow40' => 'rgba(255,102,64,0.18)', 'bg_from' => '#2a0f00', 'bg_to' => '#1a0800', 'badge_bg' => 'rgba(255,102,64,0.12)'],
        'Hydro'   => ['primary' => '#4fc3f7', 'glow' => 'rgba(79,195,247,0.40)',  'glow22' => 'rgba(79,195,247,0.22)',  'glow30' => 'rgba(79,195,247,0.30)',  'glow40' => 'rgba(79,195,247,0.18)',  'bg_from' => '#001a2a', 'bg_to' => '#00101a', 'badge_bg' => 'rgba(79,195,247,0.12)'],
        'Cryo'    => ['primary' => '#a8e4f0', 'glow' => 'rgba(168,228,240,0.40)', 'glow22' => 'rgba(168,228,240,0.22)','glow30' => 'rgba(168,228,240,0.30)','glow40' => 'rgba(168,228,240,0.18)','bg_from' => '#001a22', 'bg_to' => '#00111a', 'badge_bg' => 'rgba(168,228,240,0.12)'],
        'Electro' => ['primary' => '#c77dff', 'glow' => 'rgba(199,125,255,0.40)', 'glow22' => 'rgba(199,125,255,0.22)','glow30' => 'rgba(199,125,255,0.30)','glow40' => 'rgba(199,125,255,0.18)','bg_from' => '#1a0028', 'bg_to' => '#100018', 'badge_bg' => 'rgba(199,125,255,0.12)'],
        'Dendro'  => ['primary' => '#7ec850', 'glow' => 'rgba(126,200,80,0.40)',  'glow22' => 'rgba(126,200,80,0.22)', 'glow30' => 'rgba(126,200,80,0.30)', 'glow40' => 'rgba(126,200,80,0.18)', 'bg_from' => '#0a1a00', 'bg_to' => '#061000', 'badge_bg' => 'rgba(126,200,80,0.12)'],
        'Anemo'   => ['primary' => '#80ffe8', 'glow' => 'rgba(128,255,232,0.40)', 'glow22' => 'rgba(128,255,232,0.22)','glow30' => 'rgba(128,255,232,0.30)','glow40' => 'rgba(128,255,232,0.18)','bg_from' => '#001a18', 'bg_to' => '#001010', 'badge_bg' => 'rgba(128,255,232,0.12)'],
    ];

    $p              = $palette[$element] ?? $palette['Geo'];
    $primary        = $p['primary'];
    $glow           = $p['glow'];
    $glow22         = $p['glow22'];
    $glow30         = $p['glow30'];
    $glow40         = $p['glow40'];
    $bgFrom         = $p['bg_from'];
    $bgTo           = $p['bg_to'];
    $badgeBg        = $p['badge_bg'];
    // Ícone do elemento via genshin.jmp.blue
    $elementSlug    = strtolower($element);
    $elementIconUrl = "https://genshin.jmp.blue/elements/{$elementSlug}/icon";

    // Ícone de região: SVG genérico (API externa estava quebrando)

    // Ícones dos tipos de arma (puxando da Wiki, pois a API não tem a categoria genérica)
    $weaponIcons = [
        'Sword'    => 'https://static.wikia.nocookie.net/gensin-impact/images/8/81/Icon_Sword.png',
        'Claymore' => 'https://static.wikia.nocookie.net/gensin-impact/images/6/66/Icon_Claymore.png',
        'Polearm'  => 'https://static.wikia.nocookie.net/gensin-impact/images/6/6a/Icon_Polearm.png',
        'Catalyst' => 'https://static.wikia.nocookie.net/gensin-impact/images/2/27/Icon_Catalyst.png',
        'Bow'      => 'https://static.wikia.nocookie.net/gensin-impact/images/8/81/Icon_Bow.png',
    ];
    // Se não encontrar o nome no array, ele usa a Espada por padrão
    $weaponIconUrl = $weaponIcons[$weapon] ?? $weaponIcons['Sword']; 

    $starCount = min(max((int)$stars, 1), 5);

    $imageSrc = null;
    if ($image) {
        $imageSrc = \Illuminate\Support\Str::startsWith($image, ['http://', 'https://'])
            ? $image
            : asset($image);
    }
@endphp

{{-- Todos os seletores usam #{{ $uid }} para isolar os estilos por instância --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Crimson+Pro:ital,wght@0,300;0,400;0,600;1,400&display=swap');

    #{{ $uid }} {
        display: flex;
        flex-direction: column;
        height: 100%;
        font-family: 'Crimson Pro', Georgia, serif;
    }

    #{{ $uid }} .gc {
        width: 100%;
        height: 100%;
        background: linear-gradient(170deg, {{ $bgFrom }} 0%, #0d1520 55%, {{ $bgTo }} 100%);
        border-radius: 20px;
        border: 1.5px solid {{ $primary }};
        box-shadow:
            0 0 0 1px rgba(255,255,255,0.04),
            0 12px 40px rgba(0,0,0,0.75),
            0 0 60px {{ $glow }};
        overflow: hidden;
        position: relative;
        color: #f0e8d8;
        display: flex;
        flex-direction: column;
        transition: transform 0.35s cubic-bezier(.22,.68,0,1.2), box-shadow 0.35s ease;
    }

    #{{ $uid }} .gc:hover {
        transform: translateY(-6px);
        box-shadow:
            0 0 0 1px rgba(255,255,255,0.07),
            0 20px 56px rgba(0,0,0,0.85),
            0 0 90px {{ $glow }};
    }

    #{{ $uid }} .gc::before,
    #{{ $uid }} .gc::after {
        content: '';
        position: absolute;
        width: 36px; height: 36px;
        border-color: {{ $primary }};
        border-style: solid;
        opacity: 0.5;
        z-index: 20;
        pointer-events: none;
    }
    #{{ $uid }} .gc::before { top: 10px; left: 10px; border-width: 2px 0 0 2px; border-radius: 8px 0 0 0; }
    #{{ $uid }} .gc::after  { bottom: 10px; right: 10px; border-width: 0 2px 2px 0; border-radius: 0 0 8px 0; }

    /* Image area */
    #{{ $uid }} .gc-img-wrap {
        position: relative;
        height: 340px;
        overflow: hidden;
        clip-path: none;
    }

    #{{ $uid }} .gc-img-bg {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, {{ $bgFrom }} 0%, {{ $bgTo }} 100%);
    }

    #{{ $uid }} .gc-img-texture {
        position: absolute;
        inset: 0;
        opacity: 0.035;
        background-image: repeating-linear-gradient(
            -55deg,
            transparent 0px, transparent 6px,
            rgba(255,255,255,1) 6px, rgba(255,255,255,1) 7px
        );
    }

    #{{ $uid }} .gc-img {
        position: absolute;
        inset: 0;
        width: 100%; height: 100%;
        object-fit: cover;
        object-position: top center;
        z-index: 2;
    }

    #{{ $uid }} .gc-img-placeholder {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 110px;
        opacity: 0.1;
        z-index: 2;
    }

    #{{ $uid }} .gc-img-fade {
        position: relative;
        margin-top: -80px;
        height: 80px;
        background: linear-gradient(to bottom, transparent 0%, #0d1520 100%);
        z-index: 4;
        pointer-events: none;
    }

    #{{ $uid }} .gc-element-badge {
        position: absolute;
        top: 14px; left: 14px;
        background: {{ $badgeBg }};
        border: 1px solid {{ $primary }};
        border-radius: 50px;
        padding: 5px 12px 5px 8px;
        display: flex;
        align-items: center;
        gap: 6px;
        backdrop-filter: blur(10px);
        z-index: 10;
    }
    #{{ $uid }} .gc-element-icon { width: 18px; height: 18px; object-fit: contain; display: block; }
    #{{ $uid }} .gc-element-text {
        font-family: 'Cinzel', serif;
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 0.1em;
        color: {{ $primary }};
    }

    #{{ $uid }} .gc-stars {
        position: absolute;
        bottom: 18px; left: 18px;
        display: flex;
        gap: 4px;
        z-index: 10;
    }
    #{{ $uid }} .gc-star {
        width: 18px; height: 18px;
        color: {{ $primary }};
        filter: drop-shadow(0 0 5px {{ $primary }});
    }

    /* Body */
    #{{ $uid }} .gc-body { padding: 0 20px 22px; display: flex; flex-direction: column; flex: 1; }

    #{{ $uid }} .gc-name-block {
        padding: 16px 0 13px;
        border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    #{{ $uid }} .gc-name {
        font-family: 'Cinzel', serif;
        font-size: 25px;
        font-weight: 700;
        letter-spacing: 0.06em;
        color: {{ $primary }};
        text-shadow: 0 0 22px {{ $glow }}, 0 2px 4px rgba(0,0,0,0.6);
        line-height: 1.1;
    }
    #{{ $uid }} .gc-constellation {
        font-size: 11px;
        font-style: italic;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: rgba(240,232,216,0.38);
        margin-top: 5px;
    }

    #{{ $uid }} .gc-attrs {
        display: flex;
        padding: 14px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.07);
        margin: 0 -20px;
        background: rgba(0,0,0,0.18);
    }
    #{{ $uid }} .gc-attr { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 7px; }
    #{{ $uid }} .gc-attr + .gc-attr { border-left: 1px solid rgba(255,255,255,0.07); }

    #{{ $uid }} .gc-attr-icon {
        width: 33px; height: 33px;
        background: {{ $badgeBg }};
        border: 1.5px solid {{ $primary }};
        border-radius: 6px;
        transform: rotate(45deg);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    #{{ $uid }} .gc-attr-icon span { transform: rotate(-45deg); font-size: 13px; display: block; line-height: 1; }

    #{{ $uid }} .gc-attr-label {
        font-family: 'Cinzel', serif;
        font-size: 8.5px;
        letter-spacing: 0.13em;
        text-transform: uppercase;
        color: rgba(240,232,216,0.36);
    }
    #{{ $uid }} .gc-attr-value {
        font-size: 13px;
        font-weight: 600;
        color: rgba(240,232,216,0.88);
        text-align: center;
    }

    #{{ $uid }} .gc-info { padding: 14px 0 6px; display: flex; flex-direction: column; gap: 12px; flex: 1; }
    #{{ $uid }} .gc-info-label {
        font-family: 'Cinzel', serif;
        font-size: 8.5px;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: {{ $primary }};
        opacity: 0.8;
        margin-bottom: 4px;
    }
    #{{ $uid }} .gc-info-value {
        font-size: 13.5px;
        line-height: 1.5;
        font-style: italic;
        color: rgba(240,232,216,0.72);
    }
    #{{ $uid }} .gc-rule {
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(255,255,255,0.1), transparent);
        margin: 0 12px;
    }

    #{{ $uid }} .gc-footer { padding: 14px 0 0; display: flex; justify-content: center; }
    #{{ $uid }} .gc-affil {
        background: {{ $badgeBg }};
        border: 1px solid {{ $glow40 }};
        border-radius: 50px;
        padding: 5px 20px;
        font-family: 'Cinzel', serif;
        font-size: 9.5px;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: {{ $primary }};
    }
</style>

<div id="{{ $uid }}">
    <div class="gc">

        <div class="gc-img-wrap">
            <div class="gc-img-bg"></div>
            <div class="gc-img-texture"></div>
            @if($imageSrc)
                <img src="{{ $imageSrc }}" alt="{{ $name }}" class="gc-img">
            @else
                <div class="gc-img-placeholder">⚔</div>
            @endif

            <div class="gc-element-badge">
                <img src="{{ $elementIconUrl }}" alt="{{ $element }}" class="gc-element-icon">
                <span class="gc-element-text">{{ $element }}</span>
            </div>

            <div class="gc-stars">
                @for($i = 0; $i < $starCount; $i++)
                    <svg class="gc-star" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                @endfor
            </div>
        </div>

        <div class="gc-img-fade"></div>
        <div class="gc-body">

            <div class="gc-name-block">
                <div class="gc-name">{{ $name }}</div>
                <div class="gc-constellation">{{ $constellation }}</div>
            </div>

            <div class="gc-attrs">
                <div class="gc-attr">
                    <div class="gc-attr-icon">
                        <img src="{{ $elementIconUrl }}" alt="{{ $element }}" style="transform:rotate(-45deg);width:16px;height:16px;object-fit:contain;">
                    </div>
                    <div class="gc-attr-label">Element</div>
                    <div class="gc-attr-value">{{ $element }}</div>
                </div>
                
                <div class="gc-attr">
                    <div class="gc-attr-icon">
                        <img src="{{ $weaponIconUrl }}" alt="{{ $weapon }}" style="transform:rotate(-45deg);width:16px;height:16px;object-fit:contain; filter: brightness(1.2);">
                    </div>
                    <div class="gc-attr-label">Weapon</div>
                    <div class="gc-attr-value">{{ $weapon }}</div>
                </div>
                
                <div class="gc-attr">
                    <div class="gc-attr-icon">
                        <svg style="transform:rotate(-45deg);width:20px;height:20px;flex-shrink:0;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" fill="{{ $primary }}" opacity="0.85"/><circle cx="12" cy="9" r="2.5" fill="white" opacity="0.9"/></svg>
                    </div>
                    <div class="gc-attr-label">Region</div>
                    <div class="gc-attr-value">{{ $region }}</div>
                </div>
            </div>

            <div class="gc-info">
                <div>
                    <div class="gc-info-label">Playstyle</div>
                    <div class="gc-info-value">{{ $playstyle }}</div>
                </div>
                <div class="gc-rule"></div>
                <div>
                    <div class="gc-info-label">Mechanics</div>
                    <div class="gc-info-value">{{ $mechanics }}</div>
                </div>
            </div>

            <div class="gc-footer">
                <div class="gc-affil">{{ $affiliation }}</div>
            </div>

        </div>
    </div>
</div>