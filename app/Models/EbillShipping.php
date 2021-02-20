<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ebill;

class EbillShipping extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ebill_shippings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ebill_id', 'shipping_type', 'transport_name', 'bill_number', 'bill_receipt_img', 'courier_name','tracking_number', 'courier_receipt_img', 'lt_driver_name', 'lt_driver_mobile','lt_vehcile_number', 'lt_owner_name', 'lt_driver_img','lt_loading_vehcile_img', 'lt_driver_identity', 'lt_driver_identity_img', 'lt_driver_otp'
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
    public function ebill()
    {
        return $this->belongsTo(Ebill::class, 'ebill_id', 'id');
    }
}
