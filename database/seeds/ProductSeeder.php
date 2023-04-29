<?php

use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1 ; $i < 15; $i++){
            Products::create([
                'user_id' => 1,
            ]);
        }
    }
}
