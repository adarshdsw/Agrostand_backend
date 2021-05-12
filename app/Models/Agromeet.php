<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agromeet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agromeets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meeting_title', 'meeting_title_hindi', 'meeting_description', 'meeting_description_hindi', 'meeting_type','meeting_link', 'meeting_date_time', 'status'
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
