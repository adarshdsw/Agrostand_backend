<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assured extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assures';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'title_hindi', 'slug', 'amount', 'status',
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
