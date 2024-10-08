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

            $table->string('titre');
            $table->text('description');
            $table->string('lieu');
            $table->date('date');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->time('heure');
            $table->integer('participants')->default(0); // Nombre de participants par défaut
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evenements');
    }
};