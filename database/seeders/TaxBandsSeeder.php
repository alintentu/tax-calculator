<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaxBand;

class TaxBandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaxBand::create(['lower_limit' => 0, 'upper_limit' => 5000, 'rate' => 0]);
        TaxBand::create(['lower_limit' => 5000, 'upper_limit' => 20000, 'rate' => 20]);
        TaxBand::create(['lower_limit' => 20000, 'upper_limit' => null, 'rate' => 40]);
    }
}
