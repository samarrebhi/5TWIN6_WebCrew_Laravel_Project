<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();



        
        $table->unsignedBigInteger('evenement_collecte_id');
        $table->foreign('evenement_collecte_id')->references('id')->on('evenement_collectes')->onDelete('cascade');        $table->string('comment');
        $table->integer('rating');
        $table->boolean('would_recommend');
        $table->boolean('anonymous')->nullable();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ensure this is correct
        $table->timestamps();
    });
    
  
}


    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
