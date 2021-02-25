<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserBank;
use App\Models\UserKyc;
use App\Models\Category;
use App\Models\Commodity;
use App\Models\UserRatting;
use App\Models\UserCommodity;
use App\Models\UserBusiness;
use App\Models\UserEducation;

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Faker\Provider\en_HK\Phone;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
	// $faker = Faker::create('en_US');
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$yCfloHYWtpUhhYT9EjwHzuBipRF9.xN2saE9fQeA1bgX99hsh8Jnq', // password
        'mobile' => $faker->unique()->phoneNumber,
        'category_id' => Category::where('parent', '0')->get()->random()->id,
        'subcategory_id' => Category::where('parent', '!=', '0')->get()->random()->id,
        'commodity_id' 	=> Commodity::all()->get()->random()->id,
        'role_id' 		=> 1,
        'assured_id' 		=> 1,
        'is_verified' 		=> '1',
        'language_id' 		=> 2,
        'remember_token' => Str::random(10),
    ];
});
