<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRatting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_ratting';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'user_by', 'ratting'
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
