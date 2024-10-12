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
        Schema::create('category_reservation', function (Blueprint $table) {
            // $table->id();

           $table->unsignedBigInteger('category_id');
           $table->unsignedBigInteger('reservation_id');
           $table->integer('quantity');  // Quantité réservée pour chaque catégorie
           $table->timestamps();


            // Foreign key constraints
           $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
           $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_reservation');
    }
};
