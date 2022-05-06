<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->sentence;
    static $id = 1;
    return [
        //
        'id' => $id++,
        'name' => $name,
        'slug' => Str::slug($name),
        'parent_id' => 0,
        'created_at' => Carbon::now()->toDateString(),
        'updated_at' => Carbon::now()->toDateString(),
    ];
});
