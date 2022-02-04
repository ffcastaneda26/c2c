<?php

namespace Database\Seeders;

use App\Models\Range;
use Illuminate\Database\Seeder;

class RangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Range::create([
			'price_from'=> 0.01,
			'price_to'  => 19999.99
        ]);

        Range::create([
			'price_from'=> 20000.00,
			'price_to'  => 49999.99
        ]);

        Range::create([
			'price_from'=> 50000.00,
			'price_to'  => 59999.99
        ]);

        Range::create([
			'price_from'=> 60000.00,
			'price_to'  => 999999.99
        ]);

    }
}
