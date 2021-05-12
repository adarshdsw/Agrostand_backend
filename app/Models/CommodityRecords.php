<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommodityRecords extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'data_record';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'timestamp', 'state', 'district', 'market', 'commodity', 'variety','arrival_date', 'min_price', 'max_price', 'modal_price', 'created','updated',
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
        
    ];
}
