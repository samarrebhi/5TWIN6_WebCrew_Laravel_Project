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
                $table->text('body');
                $table->string('category');

                $table->string('external_links')->nullable();
                $table->string('tags')->nullable();
                $table->timestamps();
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
