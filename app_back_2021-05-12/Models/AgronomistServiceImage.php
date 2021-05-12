<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgronomistServiceImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'service_images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id', 'image_name', 'service_image',
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
}
