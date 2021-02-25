<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\EbillProducts;
use App\Models\EbillExpenses;
use App\Models\DriverTracking;

class Ebill extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ebills';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'vendor_id', 'order_id', 'bill_number', 'specification', 'ship_to', 'bill_to', 'bill_date', 'due_date', 'advance_amount', 'due_amount', 'total_amount', 'status', 'rfp_status', 'decline_reason', 'seller_type'
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
    /**
     * Get the user which belongs to this product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->with(['address']);
    }
    /**
     * Get the user which belongs to this product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }
    /**
     * Get the user which belongs to this product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expenses()
    {
        return $this->hasOne(EbillExpenses::class, 'ebill_id', 'id');
    }

    public function products(){
    	return $this->belongsToMany(EbillProducts::class, 'ebill_belongs_many_products', 'ebill_id', 'ebill_product_id');
    }

    /**
     * Get the user which belongs to this product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->hasOne(DriverTracking::class, 'ebill_id', 'id');
    }
}
