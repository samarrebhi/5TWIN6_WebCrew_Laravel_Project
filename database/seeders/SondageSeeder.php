<?php

namespace Database\Seeders;

use App\Models\Sondage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SondageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Sondage::factory(10)->create();

    }
}
