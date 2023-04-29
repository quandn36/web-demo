<?php

use Illuminate\Database\Seeder;
use App\Models\Stores;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1 ; $i < 15; $i++){
            Stores::create([
                'user_id' => 1,
            ]);
        }
    }
}
