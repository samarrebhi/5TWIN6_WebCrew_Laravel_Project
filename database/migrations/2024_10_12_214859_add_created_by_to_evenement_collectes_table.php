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
    Schema::table('evenement_collectes', function (Blueprint $table) {
        $table->unsignedBigInteger('created_by')->nullable(); // Assuming you're using unsigned big integers
        // Add a foreign key constraint if necessary
        $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('evenement_collectes', function (Blueprint $table) {
        $table->dropForeign(['created_by']);
        $table->dropColumn('created_by');
    });
}

};
