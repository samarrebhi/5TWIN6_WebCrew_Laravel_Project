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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->unsignedBigInteger('user_id');  
            $table->unsignedBigInteger('center_id');  

            $table->string('title');  
            $table->text('description');  
            $table->enum('status', ['in_progress', 'seen'])->default('in_progress'); 
            $table->enum('category', ['service', 'quality', 'time', 'other'])->default('other'); 
            $table->string('attachment')->nullable();  
            $table->text('admin_note')->nullable();  
            


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  
            $table->foreign('center_id')->references('id')->on('centers')->onDelete('cascade');  

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claims');
    }
};
