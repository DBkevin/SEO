<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Post;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Post::class, function (Faker $faker) {
    $sentence = $faker->sentence();
    return [
        'user_id'=>1,
        'category_id'=>1,
        'title'=>$sentence,
        'slug'=>$faker->word(),
        'description'=>$faker->sentence(),
        'meta_image'=>"/storage/default.png",
        'body'=>$faker->text(),
        'view_count'=>0,
        'praise_count'=>0,

    ];

});
