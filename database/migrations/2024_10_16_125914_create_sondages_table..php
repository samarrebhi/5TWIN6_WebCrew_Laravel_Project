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
        Schema::create('sondages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            //$table->string('location', 255);  // or any length you want

            $table->text('category');
            $table->text('questions',255);
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();


        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

           // $table->foreignId('guide_bp_id')->constrained()->onDelete('cascade');

           // $table->foreignId('guide_bp_id')->constrained('guide_b_p_s')->onDelete('cascade'); // Add nullable here
            $table->foreignId('guide_bp_id')->nullable()->references('id')->on('guide_b_p_s')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sondages');
    }
};
