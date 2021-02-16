<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgronomistLeadImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agronomist_lead_images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agronimist_lead_id', 'img_path', 'img_value', 'media_type',
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
}
