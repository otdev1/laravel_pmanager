<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker){

    return [
        'name' => $faker->text(50),
        'description' => $faker->text(400),
        'user_id' => factory('App\User')->create()->id,
    ];
    
});


