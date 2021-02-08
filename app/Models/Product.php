<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ProductImage;
use App\Models\ProductOffer;
use App\Models\ProductPrice;
use App\Models\ProductRatting;

class Product extends Model
{
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
        'user_id', 'category_id', 'subcategory_id', 'commodity_id', 'brand_id', 'title', 'description', 'product_url', 'website_url', 'feature_img', 'document', 'package_size','unit', 'product_use', 'specification', 'status'
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
}
