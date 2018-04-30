<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Product', 50)->create([
            'brand_id' => 1,
            'image' => implode('', array_random(['images/fashion/1.jpg', 'images/fashion/2.jpg', 'images/fashion/3.jpg', 'images/fashion/4.jpg', 'images/fashion/5.jpg'], 1)),
        ])->each(function ($p) {
            $p->category()->sync(1);
            $p->tag()->sync([2, 45, 3, 7, 8]);
            $attIds = \App\Theme::getRandomaArray(8);
            foreach ($attIds as $id){
                if($id > 0){
                    $p->attribute()->attach($id);
                }
            }
        });

        factory('App\Product', 50)->create([
            'brand_id' => 2,
            'image' => implode('', array_random(['images/watches/1.jpg', 'images/watches/2.jpg', 'images/watches/3.jpg', 'images/watches/4.jpg', 'images/watches/5.jpg'], 1)),
        ])->each(function ($p) {
            $p->category()->sync(2);
            $p->tag()->sync([12, 22, 13, 37, 48]);
        });

        factory('App\Product', 50)->create([
            'brand_id' => 3,
            'image' => implode('', array_random(['images/furniture/1.jpg', 'images/furniture/2.jpg', 'images/furniture/3.jpg', 'images/furniture/4.jpg', 'images/furniture/5.jpg'], 1)),
        ])->each(function ($p) {
            $p->category()->sync(3);
            $p->tag()->sync([4, 44, 23, 32, 48]);
        });

        factory('App\Product', 50)->create([
            'brand_id' => 4,
            'image' => implode('', array_random(['images/dining/1.jpg', 'images/dining/2.jpg', 'images/dining/3.jpg', 'images/dining/4.jpg', 'images/dining/5.jpg'], 1)),
        ])->each(function ($p) {
            $p->category()->sync(4);
            $p->tag()->sync([6, 12, 7, 32, 48]);
        });
    }
}
