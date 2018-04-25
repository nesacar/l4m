<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'user_id' => 1,
        'blog_id' => 1,
        'title' => $title,
        'slug' => str_slug($title),
        'short' => $faker->paragraphs(1, true),
        'body' => $faker->paragraphs(2, true),
        'image' => implode('',array_random(['storage/images/slider1.jpeg', 'storage/images/slider2.jpeg', 'storage/images/slider3.jpeg'], 1)),
        'publish_at' => $faker->dateTimeBetween('-30 days', 'now'),
        'slider' => rand(0,1),
        'publish' => 1,
    ];
});
