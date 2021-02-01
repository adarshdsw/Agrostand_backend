<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_offer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'offer_name', 'discount', 'amount', 'start_offer', 'end_offer', 'offer_specification',
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
        'created_at', 'updated_at', 'deleted_at'
    ];
}
