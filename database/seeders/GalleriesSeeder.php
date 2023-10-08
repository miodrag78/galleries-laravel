<?php

namespace Database\Seeders;

use App\Models\Gallery; // Promenite putanju
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gallery::factory(25)->create(); // Ovde koristimo fabriku za model Gallery i tražimo da se kreira 25 instanci
    }
}