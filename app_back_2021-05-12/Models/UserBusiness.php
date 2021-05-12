<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserBusinessDocs;

class UserBusiness extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_business';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'business_name', 'owner_name', 'business_address', 'gstin', 'business_contact', 'business_email', 'business_video_url', 'business_image_url'
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
     * Get the address which belongs to this user.
    */
    public function business_docs(){
        return $this->hasMany(UserBusinessDocs::class, 'user_business_id', 'id');
    }
}
