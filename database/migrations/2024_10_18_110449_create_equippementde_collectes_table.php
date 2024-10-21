<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equippementde_collectes', function (Blueprint $table) {
            $table->id(); // Identifiant unique de l'équipement
            $table->string('nom'); // Nom de l'équipement
            $table->string('statut'); // Statut : actif, maintenance, hors service
            $table->integer('capacite'); // Capacité en litres ou kilogrammes
            $table->string('emplacement'); // Emplacement actuel
            $table->string('image')->nullable(); // Image nullable
          //  $table->foreignId('center_id')->constrained()->onDelete('cascade'); // Ajoutez cette ligne
       //   $table->foreignId('user_id')->constrained()->onDelete('cascade');  
       $table->foreignId('center_id')->constrained('centers')->onDelete('cascade');
       $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
       $table->timestamps(); // Champs created_at et updated_at
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equippementde_collectes');
    }
};
