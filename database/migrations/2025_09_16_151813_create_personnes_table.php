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
        Schema::create('personnes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('localite_id')->constrained()->onDelete('cascade');
        $table->foreignId('eglise_id')->constrained()->onDelete('cascade');
        $table->foreignId('admin_createur_id')->constrained('users')->onDelete('cascade');

        // Étape Identité
        $table->string('nom');
        $table->string('prenom');
        $table->date('date_naissance');
        $table->string('lieu_naissance');
        $table->string('sexe');
        $table->string('numero_cip')->nullable();
        $table->date('date_delivrance_cip')->nullable();
        $table->string('lieu_delivrance_cip')->nullable();
        $table->date('date_expiration_cip')->nullable();
        $table->string('situation_matrimoniale');
        $table->string('profession');
        $table->text('adresse_exacte');

        // Étape Filiation (on peut les rendre nullable si elles sont optionnelles)
        $table->string('nom_pere')->nullable();
        $table->string('prenom_pere')->nullable();
        $table->string('nom_mere')->nullable();
        $table->string('prenom_mere')->nullable();

        // Étape Contact
        $table->string('nationalite');
        $table->string('email')->nullable();
        $table->string('telephone');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnes');
    }
};
