<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ebill;

class DriverTracking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'driver_tracking';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ebill_id','driver_id','delivery_otp','is_delivered','last_updated_location', 'status'
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
        return $this->belongsTo(Ebill::class, 'ebill_id', 'id');
    }
}
