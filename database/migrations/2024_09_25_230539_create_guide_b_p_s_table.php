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
            $table->string('title',255);                  // Title of the guide
            $table->text('description');              // Description of the guide
            $table->longText('content');              // Main content or body of the guide
            $table->string('category');                // Category of best practices
            $table->string('author');                  // Author of the guide
            $table->enum('status', ['published', 'draft', 'archived']); // Status of the guide
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
        Schema::dropIfExists('guide_b_p_s');
    }
};
