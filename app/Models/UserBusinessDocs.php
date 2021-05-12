<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBusinessDocs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_business_docs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_business_id', 'title', 'business_doc', 'doc_extention'
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
