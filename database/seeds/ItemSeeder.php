<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $items = [
        [
          'category_id' => '1',
          'name' => 'hotdog',
          'price' => 20,
          'tax' => 12,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
        ],
        [
          'category_id' => '1',
          'name' => 'cheese burger',
          'price' => 30,
          'tax' => 12,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
        ],
        [
          'category_id' => '1',
          'name' => 'fries',
          'price' => 20,
          'tax' => 12,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
        ],
        [
          'category_id' => '2',
          'name' => 'coke',
          'price' => 20,
          'tax' => 12,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
        ],

        [
          'category_id' => '2',
          'name' => 'sprite',
          'price' => 20,
          'tax' => 12,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
        ],

        [
          'category_id' => '2',
          'name' => 'tea',
          'price' => 20,
          'tax' => 12,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
        ],
        [
          'category_id' => '3',
          'name' => 'chicken combo',
          'price' => 20,
          'tax' => 12,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
        ],

        [
          'category_id' => '3',
          'name' => 'pork combo',
          'price' => 20,
          'tax' => 12,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
        ],

        [
          'category_id' => '3',
          'name' => 'fish combo',
          'price' => 20,
          'tax' => 12,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
        ],
      ];

      foreach ($items as $item) {
        DB::table('items')->insert($item);
      }
    }
}
