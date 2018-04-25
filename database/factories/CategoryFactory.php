<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'short' => $faker->paragraph,
        'order' => rand(1,10),
        'parent' => rand(0,2),
        'level' => 1,
        'image' => $faker->image(public_path('storage/images/category.jpg'), 980, 180),
        'publish' => 1,
    ];
});
