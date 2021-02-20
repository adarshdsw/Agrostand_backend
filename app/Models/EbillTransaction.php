<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ebill;

class EbillTransaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ebill_transactions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ebill_id','sender_id','receiver_id','transaction_amount', 'status'
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
