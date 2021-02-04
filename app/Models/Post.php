<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PostImage;
use App\Models\PostLike;
use App\Models\PostFavorite;
use App\Models\PostComment;

class Post extends Model
{
    use SoftDeletes; // <-- Use This Instead Of SoftDeletingTrait
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'title', 'description', 'feature_img', 'status', 'views', 'postImages'
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
     * Get the user which belongs to this blog post.
    */
    public function user(){
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the extra images for the blog post.
    */
    public function postImages(){
    	return $this->hasMany(PostImage::class, 'post_id', 'id');
    }
    /**
     * Get the Likes for the blog post.
    */
    public function likes(){
    	return $this->hasMany(PostLike::class, 'post_id', 'id');
    }
    /**
     * Get the favorites for the blog post.
    */
    public function favorites(){
    	return $this->hasMany(PostFavorite::class, 'post_id', 'id');
    }
    /**
     * Get the favorites for the blog post.
    */
    public function is_favorite(){
        return $this->hasOne(PostFavorite::class, 'post_id', 'id');
    }
    /**
     * Get the favorites for the blog post.
    */
    public function is_like(){
        return $this->hasOne(PostLike::class, 'post_id', 'id');
    }
    /**
     * Get the comments for the blog post.
    */
    public function comments(){
    	return $this->hasMany(PostComment::class, 'post_id', 'id')->with('user');
    }

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($post) { // before delete() method call this
            $post->postImages()->delete();
            $post->likes()->delete();
            $post->favorites()->delete();
            $post->comments()->delete();
            // do the rest of the cleanup...
        });
    }
}
