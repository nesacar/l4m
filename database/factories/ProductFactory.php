<?php

use Faker\Generator as Faker;

/**
 * Fashion factory
 */
$factory->define(App\Product::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'user_id' => 1,
        'brand_id' => 1,
        'collection_id' => null,
        'title' => $title,
        'slug' => str_slug($title),
        'short' => $faker->paragraph,
        'body' => $faker->paragraphs(3, true),
        'body2' => $faker->paragraphs(3, true),
        'code' => $faker->word,
        'price' => rand(100, 300),
        'price_outlet' => rand(80, 150),
        'amount' => rand(1, 3),
        'image' => implode('',array_random(['images/fashion/1.jpg', 'images/fashion/2.jpg', 'images/fashion/3.jpg', 'images/fashion/4.jpg', 'images/fashion/5.jpg'], 1)),
        'publish_at' => $faker->dateTimeBetween('-30 days', 'now'),
        'publish' => 1,
    ];
});

///**
// * Watches factory
// */
//$factory->define(App\Product::class, function (Faker $faker) {
//    $title = $faker->sentence;
//    return [
//        'user_id' => 1,
//        'brand_id' => 2,
//        'collection_id' => null,
//        'title' => $title,
//        'slug' => str_slug($title),
//        'short' => $faker->paragraph,
//        'body' => $faker->paragraphs(3, true),
//        'body2' => $faker->paragraphs(3, true),
//        'code' => $faker->word,
//        'price' => rand(100, 300),
//        'price_outlet' => rand(80, 150),
//        'amount' => rand(1, 3),
//        'image' => implode('',array_random(['images/watches/1.jpg', 'images/watches/2.jpg', 'images/watches/3.jpg', 'images/watches/4.jpg', 'images/watches/5.jpg'], 1)),
//        'publish_at' => $faker->dateTimeBetween('-30 days', 'now'),
//        'publish' => 1,
//    ];
//})->each(function($p) {
//    $p->category()->attach(2);
//});
//
///**
// * furniture factory
// */
//$factory->define(App\Product::class, function (Faker $faker) {
//    $title = $faker->sentence;
//    return [
//        'user_id' => 1,
//        'brand_id' => 3,
//        'collection_id' => null,
//        'title' => $title,
//        'slug' => str_slug($title),
//        'short' => $faker->paragraph,
//        'body' => $faker->paragraphs(3, true),
//        'body2' => $faker->paragraphs(3, true),
//        'code' => $faker->word,
//        'price' => rand(100, 300),
//        'price_outlet' => rand(80, 150),
//        'amount' => rand(1, 3),
//        'image' => implode('',array_random(['images/furniture/1.jpg', 'images/furniture/2.jpg', 'images/furniture/3.jpg', 'images/furniture/4.jpg', 'images/furniture/5.jpg'], 1)),
//        'publish_at' => $faker->dateTimeBetween('-30 days', 'now'),
//        'publish' => 1,
//    ];
//})->each(function($p) {
//    $p->category()->attach(3);
//});
//
///**
// * Dining factory
// */
//$factory->define(App\Product::class, function (Faker $faker) {
//    $title = $faker->sentence;
//    return [
//        'user_id' => 1,
//        'brand_id' => 4,
//        'collection_id' => null,
//        'title' => $title,
//        'slug' => str_slug($title),
//        'short' => $faker->paragraph,
//        'body' => $faker->paragraphs(3, true),
//        'body2' => $faker->paragraphs(3, true),
//        'code' => $faker->word,
//        'price' => rand(100, 300),
//        'price_outlet' => rand(80, 150),
//        'amount' => rand(1, 3),
//        'image' => implode('',array_random(['images/dining/1.jpg', 'images/dining/2.jpg', 'images/dining/3.jpg', 'images/dining/4.jpg', 'images/dining/5.jpg'], 1)),
//        'publish_at' => $faker->dateTimeBetween('-30 days', 'now'),
//        'publish' => 1,
//    ];
//})->each(function($p) {
//    $p->category()->attach(4);
//});
