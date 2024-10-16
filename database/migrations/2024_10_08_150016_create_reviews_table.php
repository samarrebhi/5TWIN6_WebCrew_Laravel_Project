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



        
        $table->foreignId('evenement_collecte_id')->constrained()->onDelete('cascade'); // Ensure this is correct
        $table->string('comment');
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
