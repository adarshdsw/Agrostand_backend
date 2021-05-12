<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserAddress;
use App\Models\UserBank;
use App\Models\UserKyc;
use App\Models\UserCommodity;
use App\Models\UserBusiness;
use App\Models\UserEducation;
use App\Models\UserFollower;
use App\Models\Category;
use App\Models\Commodity;
use App\Models\Product;
use App\Models\Role;
use App\Models\Assured;
use App\Models\City;
use App\Models\District;
use App\Models\State;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'subcategory_id', 'name', 'email', 'mobile', 'password','role_id', 'assured_id', 'language_id', 'country_id', 'state_id', 'address', 'land_area', 'latitude', 'longitude', 'otp', 'device_id','user_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Get the address which belongs to this user.
    */
    public function address(){
        return $this->hasOne(UserAddress::class, 'user_id', 'id')->with(['city','state','district']);
    }
    /**
     * Get the address which belongs to this user.
    */
    public function kyc(){
        return $this->hasOne(UserKyc::class, 'user_id', 'id');
    }
    /**
     * Get the address which belongs to this user.
    */
    public function bank(){
        return $this->hasOne(UserBank::class, 'user_id', 'id');
    }
    /**
     * Get the address which belongs to this user.
    */
    public function commodities(){
        return $this->hasMany(UserCommodity::class, 'user_id', 'id');
    }

    /**
     * Get the business which belongs to this user.
    */
    public function business(){
        return $this->hasOne(UserBusiness::class, 'user_id', 'id');
    }

    /**
     * Get the education which belongs to this user.
    */
    public function education(){
        return $this->hasOne(UserEducation::class, 'user_id', 'id');
    }

    /**
     * Get the has many followers this user.
    */
    public function followers(){
        return $this->hasMany(UserFollower::class, 'user_id', 'id');
    }

    /**
     * Get the category belongs to this user.
    */
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the category belongs to this user.
    */
    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * Get the category belongs to this user.
    */
    public function assured(){
        return $this->belongsTo(Assured::class, 'assured_id', 'id');
    }

    /**
     * Get the subcategory belongs to this user.
    */
    public function subcategory(){
        return $this->belongsTo(Category::class, 'subcategory_id', 'id');
    }

    /**
     * Get the commodity belongs to this user.
    */
    public function commodity(){
        return $this->belongsToMany(Commodity::class, 'user_commodities', 'commodity_id', 'user_id');
    }

    public function products(){
        return $this->hasMany(Product::class, 'user_id', 'id')->with(['price']);
    }

    public function userCommodity(){
        return $this->hasMany(UserCommodity::class, 'user_id', 'id')->with(['commodity']);
    }
    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->device_id;
    }

    public function scopeIsWithinMaxDistance($query, $coordinates, $radius = 5) {

        $haversine = "(6371 * acos(cos(radians(" . $coordinates['latitude'] . "))
                        * cos(radians(`latitude`)) 
                        * cos(radians(`longitude`) 
                        - radians(" . $coordinates['longitude'] . ")) 
                        + sin(radians(" . $coordinates['latitude'] . ")) 
                        * sin(radians(`latitude`))))";

        return $query->select('*')
                     ->selectRaw("{$haversine} AS distance")
                     ->whereRaw("{$haversine} < ?", [$radius]);
    }
}
