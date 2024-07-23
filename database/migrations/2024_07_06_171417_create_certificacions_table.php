<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('certificacions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('tipo');
            $table->string('a_nombre_de')->nullable();
            $table->string('dni_cuit')->nullable();
            $table->string('cosa_a_certificar')->nullable();
            $table->date('fecha_emision')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificacions');
    }
};
