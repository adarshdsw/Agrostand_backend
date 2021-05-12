<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchemeImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'scheme_images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'scheme_id', 'title', 'scheme_img',
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
