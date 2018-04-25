<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    $title = $faker->word;
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'publish' => 1,
    ];
});
