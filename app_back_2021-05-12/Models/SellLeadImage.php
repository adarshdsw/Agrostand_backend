<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellLeadImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sell_lead_images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sell_lead_id', 'title', 'sell_product_image',
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
