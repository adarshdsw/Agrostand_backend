<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sell;
use App\Models\User;

class SellRequest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sell_request';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sell_lead_id', 'vendor_id', 'seller_id', 'seller_type', 'request_status'
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

    public function sellLead(){
    	return $this->belongsTo(Sell::class, 'sell_lead_id', 'id')->with(['sellImages']);
    }

    public function vandor(){
    	return $this->belongsTo(User::class, 'vendor_id', 'id')->with(['address', 'business']);
    }

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id', 'id')->with(['address', 'business']);
    }
}