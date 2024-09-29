<?php

namespace Database\Seeders;

use App\Models\guideBP;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuideBPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        guideBP::factory(10)->create();
    }
}
