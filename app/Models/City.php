<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\Village;

class City extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'city';
    protected $primaryKey = 'city_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'district_id', 'city_name','created'
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

    /**
     * Get the state belongs to this district.
    */
    public function district(){
        return $this->belongsTo(District::class, 'district_id', 'district_id');
    }

    /**
     * Get the has many cities of this district.
    */
    public function villages(){
        return $this->hasMany(Village::class, 'city_id', 'city_id');
    }
}
