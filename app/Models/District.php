<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\City;

class District extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'district';
    protected $primaryKey = 'district_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state_id', 'district_name', 'created'
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
    public function state(){
        return $this->belongsTo(State::class, 'state_id', 'state_id');
    }

    /**
     * Get the has many cities of this district.
    */
    public function cities(){
        return $this->hasMany(City::class, 'district_id', 'district_id');
    }
}
