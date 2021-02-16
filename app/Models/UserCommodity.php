<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Commodity;

class UserCommodity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_commodities';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'commodity_id'
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
    /**
     * Get the address which belongs to this user.
    */
    public function commodity(){
        return $this->belongsTo(Commodity::class, 'commodity_id', 'id');
    }    
}
