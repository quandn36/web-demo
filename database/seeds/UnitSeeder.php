<?php

use Illuminate\Database\Seeder;
use App\Models\Units;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Units::create([
            'name' => 'Mét',
            'short_name' => 'M',
        ]);
        Units::create([
            'name' => 'Centimet',
            'short_name' => 'CM',
        ]);
        Units::create([
            'name' => 'Gram',
            'short_name' => 'G',
        ]);
        Units::create([
            'name' => 'Kilogram',
            'short_name' => 'Kg',
        ]);
    }
}
