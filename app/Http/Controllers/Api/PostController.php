<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostLike;
use App\Models\PostFavorite;
use App\Models\PostComment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index(Request $request)
    {
        $offset  = $request->input('offset');
        $limit   = $request->input('limit');
        $user_id = $request->input('user_id');
        $role_id = $request->input('role_id');

        $posts = Post::where('user_id', '!=', $user_id)->offset($offset)->limit($limit)->get();
        if($posts){
            $data = [];
            foreach($posts as $post){
                $row = [];
                $row['post'] = $post;
                $row['user'] = $post->user()->first();
                $row['post_images'] = $post->postImages()->get();
                $row['likes'] = $post->likes()->get();
                $row['comments'] = $post->comments()->get();
                $row['favorites'] = $post->favorites()->get();
                // $row['is_fav'] = $post->favorites()->where('user_id', $user_id)->select('favorite')->first();
                $data[] = $row;
            }
            $data = ['status' => true, 'code' => 200, 'data'=>$data];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }*/
    public function index(Request $request)
    {
        $offset  = $request->input('offset');
        $limit   = $request->input('limit');
        $user_id = $request->input('user_id');
        $is_filter = $request->input('is_filter');
        
        $total_count = Post::where('user_id', '!=' ,$user_id)->count();

        if(isset($is_filter) && !empty($is_filter)  && $is_filter != '' ){
            $posts = Post::with(['postImages', 'user', 'likes', 
                'is_like' => function($q) use($request){
                    $user_id = $request->input('user_id');
                    $q->where('user_id', '=', $user_id);
                },
                'is_favorite'=>function($q) use($request){
                    $user_id = $request->input('user_id');
                    $q->where('user_id', '=', $user_id);
                }, 'comments'])
                ->whereHas('user', function($query) use($request) {
                    
                    $role_id = $request->input('role_id');
                    $assured_id = $request->input('assured_id');

                    if(isset($role_id) && !empty($role_id)  && $role_id != '' && is_numeric($role_id) ){
                        $query->where('role_id', '=', $role_id);
                    }
                    if(isset($assured_id) && !empty($assured_id)  && $assured_id != '' && is_numeric($assured_id) ){
                        $query->where('assured_id', '=', $assured_id);
                    }
                })
                /*->whereHas('favorites', function($query) use($request){
                    $user_id = $request->input('user_id');
                    $query->where('user_id', '=', $user_id);
                })*/
                ->where('user_id', '!=' ,$user_id)->offset($offset)->limit($limit)->get();
        }else{
            $posts = Post::with(['postImages', 'user', 'likes', 
                    'is_like' => function($q) use($request){
                        $user_id = $request->input('user_id');
                        $q->where('user_id', '=', $user_id);
                    },
                    'is_favorite'=>function($q) use($request){
                        $user_id = $request->input('user_id');
                        $q->where('user_id', '=', $user_id);
                    }, 'comments'])->where('user_id', '!=' ,$user_id)->offset($offset)->limit($limit)->get();
        }

        if($posts){
            $data = ['status' => true, 'code' => 200, 'data'=>$posts, 'total_count'=>$total_count];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }
    /**
     * Display a listing of the user own posts
     *
     * @return \Illuminate\Http\Response
     *
    */
    public function userPosts(Request $request){

        $user_id = $request->input('user_id');
        $offset  = $request->input('offset');
        $limit   = $request->input('limit');
        if($user_id){
            $post = Post::with('postImages', 'user', 'likes', 'comments')->where('status', '1')->where('user_id', $user_id)->offset($offset)->limit($limit)->orderBy('id', 'DESC')->get();
            $total_count = Post::where('status', '1')->where('user_id', $user_id)->count();
            if($post){
                $data = ['status' => true, 'code' => 200, 'data'=>$post, 'total_count'=>$total_count];
            }else{
                $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
            }
        }else{
            $data = ['status' => false, 'code' => 500, 'message' => "user id not found"];
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->user_id      = $request->input('user_id');
        $post->category_id  = $request->input('category_id');
        $post->title        = $request->input('title');
        $post->description  = $request->input('description');
        $post->video_link   = ($request->input('video_link')) ? $request->input('video_link') : '';
        $file = $request->file('feature_img');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "post";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/post'), $filenew);
            $post->feature_img   = '/uploads/post/'.$filenew;
        }
        $post->views = 0;
        $post->status = $request->input('status');
        $res = $post->save();
        if($res){
            $files = $request->file('post_images');
            if($files){
                $img_extra = [];
                foreach($files as $file){
                    $row = [];
                    $filename   = $file->getClientOriginalName();
                    $name       = "post_ext";
                    $extension  = $file->extension();
                    $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                    $file->move(base_path('/public/uploads/post'), $filenew);
                    $row['post_id'] = $post->id;
                    $row['title']   = $filename;
                    $row['post_img'] = '/uploads/post/'.$filenew;
                    $img_extra[] = $row;
                }
                PostImage::insert($img_extra);
            }
            return ['status' => true, 'code' => 200, 'data'=>$post];
            
        }else{
            return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('postImages', 'user', 'likes', 'favorites', 'comments')->where('id', $id)->first();
        if($post){
            $data = ['status' => true, 'code' => 200, 'data'=>$post];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('postImages', 'user')->where('id', $id)->first();
        if($post){
            $data = ['status' => true, 'code' => 200, 'data'=>$post];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('post_id');
        $post = Post::find($id);
        if($post){
            $post->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$post];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
    /**
     * post view increase by 1.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function viewIncrement(Request $request){
        $id = $request->input('post_id');
        $post = Post::find($id);
        if($post){
            $post->views = $post->views + 1;
            $res = $post->save();
            if($res){
                return ['status' => true, 'code' => 200, 'data'=>$post];
            }else{
                return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message' => "not found data."];
        }
    }
    /**
     * post like by user.
     * [ if value of like is 1 means post id like by someone user.]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request){
        $id         = $request->input('post_id');
        $user_id    = $request->input('user_id');
        $like       = $request->input('like');
        $res = PostLike::updateOrCreate(
            ['post_id' => $id, 'user_id' => $user_id],
            ['like' => $like]
        );
        if($res){
            return ['status' => true, 'code' => 200, 'data'=>$res];
        }else{
            return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
        }
    }
    /**
     * post favorite by user.
     * [ if value of favorite is 1 means post id is favorite by someone user.]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function favorite(Request $request){
        $id         = $request->input('post_id');
        $user_id    = $request->input('user_id');
        $favorite       = $request->input('favorite');
        $res = PostFavorite::updateOrCreate(
            ['post_id' => $id, 'user_id' => $user_id],
            ['favorite' => $favorite]
        );
        if($res){
            return ['status' => true, 'code' => 200, 'data'=>$res];
        }else{
            return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
        }
    }
    /**
     * post comment by user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request){
        $id         = $request->input('post_id');
        $user_id    = $request->input('user_id');
        $comment_text = $request->input('comment');
        $comment = new PostComment();
        $comment->post_id = $id;
        $comment->user_id = $user_id;
        $comment->comment_text = $comment_text;
        $res = $comment->save();
        if($res){
            return ['status' => true, 'code' => 200, 'data'=>$comment];
        }else{
            return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
        }
    }
}
