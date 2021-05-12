<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\District;

class State extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'state';
    protected $primaryKey = 'state_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state_name', 'country_id', 'created'
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
     * Get the has many followers this user.
    */
    public function districts(){
        return $this->hasMany(District::class, 'state_id', 'state_id');
    }
}
