<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(User::class, 10)->create();
        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
        $category = Category::where('parent', '0')->get()->random()->id;
        $subcategory = Category::where('parent', '!=', '0')->get()->random()->id;
        $subcategory_id = Category::where('parent', '!=', '0')->get()->random()->id;
        echo $subcategory_id;
        $commodity = Commodity::where('subcategory_id', $subcategory_id)->get()->random()->id;
        dd($category, $subcategory, $subcategory_id, $commodity);
        dd($category,$subcategory,$subcategory_id,$commodity);
	    for($i = 0; $i < 10; $i++) {
	        App\User::create([
	            'name' => $faker->name,
		        'email' => $faker->unique()->safeEmail,
		        'email_verified_at' => now(),
		        'password' => '$2y$10$yCfloHYWtpUhhYT9EjwHzuBipRF9.xN2saE9fQeA1bgX99hsh8Jnq', // password
		        'mobile' => $faker->unique()->mobileNumber,
		        'category_id' => $category->random()->id,
		        'subcategory_id' => $subcategory_id,
		        'commodity_id' 	=> $commodity->random()->id,
		        'role_id' 		=> 1,
		        'assured_id' 		=> 1,
		        'is_verified' 		=> '1',
		        'language_id' 		=> 2,
		        'remember_token' => Str::random(10),
	        ]);
	    }
    }
}
