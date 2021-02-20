<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\AgronomistServiceImage;
use App\Models\AgronomistServiceOffer;
use App\Models\User;
use App\Models\Category;

class AgronomistService extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'service_catalogues';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'subcategory_id', 'commodity_id', 'service_name', 'description', 'specification', 'fees', 'unit', 'state_id', 'district_id', 'city_id', 'status'
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
     * Get the offer for this product.
    */
    public function offer(){
        return $this->hasOne(AgronomistServiceOffer::class, 'service_id', 'id');
    }

    /**
     * Get the offer for this product.
    */
    public function images(){
        return $this->hasMany(AgronomistServiceImage::class, 'service_id', 'id');
    }
    /**
     * Get the user which belongs to this product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
}
