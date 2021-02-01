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

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'subcategory_id', 'name', 'email', 'mobile', 'password','role_id', 'assured_id', 'language_id', 'country_id', 'state_id', 'address', 'land_area', 'latitude', 'longitude', 'otp'
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
        return $this->hasOne(UserAddress::class, 'user_id', 'id');
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
     * Get the education which belongs to this user.
    */
    public function followers(){
        return $this->hasMany(UserFollower::class, 'user_id', 'id');
    }
}
