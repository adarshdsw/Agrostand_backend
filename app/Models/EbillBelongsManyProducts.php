<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbillBelongsManyProducts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ebill_belongs_many_products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'ebill_id', 'ebill_product_id'
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
     * Get the user which belongs to this product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ebill()
    {
        return $this->belongsTo(User::class, 'ebill_id', 'id');
    }
}
