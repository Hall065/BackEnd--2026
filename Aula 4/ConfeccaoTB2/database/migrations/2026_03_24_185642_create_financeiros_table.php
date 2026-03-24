<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financeiros', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('tipo'); // receita, despesa
            $table->decimal('valor', 12, 2);
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
            $table->string('status')->default('pendente'); // pendente, pago
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financeiros');
    }
};
