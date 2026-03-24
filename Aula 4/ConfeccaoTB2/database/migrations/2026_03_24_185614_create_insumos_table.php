<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('quantidade', 12, 2)->default(0);
            $table->string('unidade')->default('un'); // m, kg, un
            $table->foreignId('fornecedor_id')->nullable()->constrained('fornecedors')->onDelete('set null');
            $table->decimal('custo_unitario', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insumos');
    }
};
