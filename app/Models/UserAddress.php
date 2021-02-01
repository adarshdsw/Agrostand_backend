<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserAddress extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_addresses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'address', 'land_area', 'country_id', 'state_id', 'city', 'district', 'village_town', 'house_number', 'latitude', 'longitude', 'pincode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * The attributes that should be mutated to dates
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];
}
