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
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
<<<<<<<< HEAD:database/migrations/2024_09_25_111158_create_centers_table.php
            $table->string('name', 255);
            $table->string('address', 255);
            $table->string('phone', 8); 
            $table->string('email');
            $table->string('description', 255);
            $table->string('image')->nullable();
========
            $table->string('titre');
            $table->text('description');
            $table->string('lieu');
            $table->date('date');
            $table->time('heure');
            $table->integer('participants')->default(0); // Nombre de participants par défaut
            $table->string('image')->nullable();

>>>>>>>> ff1571f37d7d5826af476ed6dbe4ba9756842815:database/migrations/2024_09_25_214631_evenement_collectes_table.php
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
        Schema::dropIfExists('centers');
    }
};
