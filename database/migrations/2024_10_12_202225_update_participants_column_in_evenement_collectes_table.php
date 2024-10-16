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
        $table->json('participants')->change(); // Change this to the correct data type, e.g., JSON for MySQL
    });
}

public function down()
{
    Schema::table('evenement_collectes', function (Blueprint $table) {
        $table->string('participants')->change(); // Or change it back to the previous data type
    });
}

};
