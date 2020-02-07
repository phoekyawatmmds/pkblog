<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence(),
        "content" => $faker -> paragraphs(3,true),
        "author_id" => App\User::get()->random()->id,
        "is_pulish" => $faker->boolean(80),
    ];
});
