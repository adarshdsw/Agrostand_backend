<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\ProductImage;
use App\Models\ProductOffer;
use App\Models\ProductPrice;
use App\Models\ProductRatting;
use App\Models\User;
use App\Models\Category;
use App\Models\Commodity;
use App\Models\Brand;
use App\Models\ProductGroup;
use App\Models\City;
use App\Models\District;
use App\Models\State;

class Product extends Model
{
    use SoftDeletes; // <-- Use This Instead Of SoftDeletingTrait
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_catalogues';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'subcategory_id', 'commodity_id', 'brand_id', 'title', 'description', 'product_url', 'website_url', 'feature_img', 'document', 'package_size','unit', 'product_use', 'specification', 'status', 'group_id'
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
        return $this->hasOne(ProductOffer::class, 'product_id', 'id');
    }

    /**
     * Get the offer for this product.
    */
    public function price(){
        return $this->hasOne(ProductPrice::class, 'product_id', 'id');
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
    public function pcategory()
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
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    /**
     * Get the user which belongs to this product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
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

    /**
     * Get the user which belongs to this product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    /**
     * Get the user which belongs to this product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'group_id', 'id');
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
