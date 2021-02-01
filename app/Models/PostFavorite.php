<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostFavorite extends Model
{
	use SoftDeletes; // <-- Use This Instead Of SoftDeletingTrait
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_favorites';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id', 'favorite'
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
