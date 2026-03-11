<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use Illuminate\Support\Str;

class CharacterController extends Controller
{
    public function index()
    {
        // Ordenado por raridade (5★ primeiro) e depois por nome
        $characters = Character::orderByDesc('stars')
                                ->orderBy('name')
                                ->get();

        return view('characters.index', compact('characters'));
    }

    public function create()
    {
        return view('characters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'constellation' => 'nullable|string|max:255',
            'element'       => 'required|in:Geo,Pyro,Hydro,Cryo,Electro,Dendro,Anemo',
            'weapon'        => 'required|in:Sword,Claymore,Polearm,Bow,Catalyst',
            'region'        => 'nullable|string|max:255',
            'stars'         => 'required|integer|in:4,5',
            'playstyle'     => 'nullable|string|max:255',
            'mechanics'     => 'nullable|string',
            'affiliation'   => 'nullable|string|max:255',
            'image_url'     => 'nullable|url',
        ]);

        $data = $request->all();

        // Gera URL da imagem automaticamente se não informada
        if (empty($data['image_url'])) {
            $slug = Str::slug($data['name']);
            $data['image_url'] = "https://genshin.jmp.blue/characters/{$slug}/portrait";
        }

        Character::create($data);

        return redirect()->route('characters.index')
            ->with('success', 'Personagem cadastrado com sucesso!');
    }

    public function edit(Character $character)
    {
        return view('characters.edit', compact('character'));
    }

    public function update(Request $request, Character $character)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'constellation' => 'nullable|string|max:255',
            'element'       => 'required|in:Geo,Pyro,Hydro,Cryo,Electro,Dendro,Anemo',
            'weapon'        => 'required|in:Sword,Claymore,Polearm,Bow,Catalyst',
            'region'        => 'nullable|string|max:255',
            'stars'         => 'required|integer|in:4,5',
            'playstyle'     => 'nullable|string|max:255',
            'mechanics'     => 'nullable|string',
            'affiliation'   => 'nullable|string|max:255',
            'image_url'     => 'nullable|url',
        ]);

        $data = $request->all();

        // Regenera URL da imagem automaticamente se foi apagada
        if (empty($data['image_url'])) {
            $slug = Str::slug($data['name']);
            $data['image_url'] = "https://genshin.jmp.blue/characters/{$slug}/portrait";
        }

        $character->update($data);

        return redirect()->route('characters.index')
            ->with('success', 'Personagem atualizado com sucesso!');
    }

    public function destroy(Character $character)
    {
        $character->delete();

        return redirect()->route('characters.index')
            ->with('success', 'Personagem removido com sucesso!');
    }
}
