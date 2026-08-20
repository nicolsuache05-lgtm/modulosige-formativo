<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('egresados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprentice_id')->constrained('apprentices')->onDelete('cascade');
            $table->date('graduation_date');
            $table->enum('employment_status', ['Empleado', 'Desempleado', 'Estudiante', 'Emprendedor', 'Otro'])->default('Desempleado');
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->string('salary')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('linkedin')->nullable();
            $table->text('observations')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egresados');
    }
};
