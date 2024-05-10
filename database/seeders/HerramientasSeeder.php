<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Herramienta;

class HerramientasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Herramienta::factory()->count(10)->create();
    }
}

