<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Clients;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        \App\Models\Clients::factory(10)->create();
        \App\Models\Produtos::factory(10)->create();
        \App\Models\Fornecedores::factory(10)->create();
        \App\Models\Pedidos::factory(10)->create();
        \App\Models\Estoque::factory(10)->create();
    
        // User::firstOrCreate(
        //     ['email' => 'test@example.com'],
        //     [
        //         'name' => 'Test User',
        //         'password' => bcrypt('password'),
        //     ]
        // );
    }
}
