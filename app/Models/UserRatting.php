<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRatting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_ratting';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'ratting', 'ratted_by',
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
