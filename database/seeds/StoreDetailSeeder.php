<?php

use Illuminate\Database\Seeder;
use App\Models\StoreDetail;

class StoreDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1 ; $i < 15; $i++){
            StoreDetail::create([
                'store_id' => $i,
                'user_id' => 1,
                'name' => 'Sed ut perspiciatis unde omnis ' . $i,
                'address' => 'mistaken idea of denouncing pleasure and praising ' . $i,
                'phone' => '098948839'.$i,
                'description' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio',
            ]);
        }
    }
}
