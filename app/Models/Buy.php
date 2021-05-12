<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Commodity;
use App\Models\City;
use App\Models\District;
use App\Models\State;

class Buy extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buylead';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'subcategory_id', 'commodity_id', 'product_title', 'qty', 'size', 'buy_specification', 'min_price', 'max_price', 'product_specification', 'state_id', 'district_id', 'city_id', 'location', 'address', 'latitude', 'longitude',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->with(['address','commodities','business','assured']);
    }
    /**
     * Get the user which belongs to this product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    /**
     * Get the user which belongs to this product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function psubcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id', 'id');
    }
    /**
     * Get the user which belongs to this product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commodity()
    {
        return $this->belongsTo(Commodity::class, 'commodity_id', 'id');
    }


    public function city(){
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }
    
    public function state(){
        return $this->belongsTo(State::class, 'state_id', 'state_id');
    }
    
    public function district(){
        return $this->belongsTo(District::class, 'district_id', 'district_id');
    }
}
