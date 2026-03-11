<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('constellation')->nullable();
            $table->string('element');
            $table->string('weapon');
            $table->string('region')->nullable();
            $table->integer('stars')->default(4);
            $table->string('playstyle')->nullable();
            $table->text('mechanics')->nullable();
            $table->string('affiliation')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
