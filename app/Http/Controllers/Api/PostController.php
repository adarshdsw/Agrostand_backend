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
    public function index()
    {
        //
    }
    /**
     * Display a listing of the user own posts
     *
     * @return \Illuminate\Http\Response
     *
    */
    public function userPosts($user_id = null){
        if($user_id){
            $post = Post::with('postImages', 'user', 'likes', 'favorites', 'comments')->where('user_id', $user_id)->get();
            if($post){
                $data = ['status' => true, 'code' => 200, 'data'=>$post];
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
