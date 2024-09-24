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
        Schema::create('evenement_collectes', function (Blueprint $table) {
            $table->id();
            $table->timestamps(); // Garde cette ligne pour created_at et updated_at
            $table->string('nom', 100);
            $table->dateTime('date');
            $table->string('lieu', 255);
            $table->foreignId('organisateur_id')->constrained('utilisateurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evenement_collectes');
    }
};
