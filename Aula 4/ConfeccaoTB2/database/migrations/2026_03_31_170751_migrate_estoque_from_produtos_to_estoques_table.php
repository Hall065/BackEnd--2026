<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Migra os dados antes de remover
        \App\Models\Produto::all()->each(function ($produto) {
            \App\Models\Estoque::updateOrCreate(
                ['produto_id' => $produto->id],
                ['quantidade' => $produto->estoque ?? 0]
            );
        });

        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('estoque');
        });
    }

    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->integer('estoque')->default(0);
        });
    }
};