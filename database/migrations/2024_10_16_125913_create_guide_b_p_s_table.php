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
        Schema::create('guide_b_p_s', function (Blueprint $table) {
            $table->id();


                $table->string('title');
                $table->text('content');
                $table->string('category');
               // $table->string('media')->nullable();            // Media files (optional)
                $table->string('external_links')->nullable();     // External resource links
                $table->string('tags')->nullable();               // Tags for filtering (optional)
                $table->timestamps();// created_at and updated_at
            $table->string('image')->nullable();
            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guide_b_p_s');
    }
};
