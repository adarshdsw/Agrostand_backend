<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_price';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'min_qty', 'unit', 'amount', 'last_update'
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
