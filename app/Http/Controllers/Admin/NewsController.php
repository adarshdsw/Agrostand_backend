<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $news = News::all();
        if(count($news)){
            $data = ['status' => true, 'code' => 200, 'data'=>$news];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newsList()
    {
        $data = [];
        $newses = News::all();
        return view('admin.news.index', compact('newses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $news = new News;
        $news->title        = $request->input('title');
        $news->description  = $request->input('description');
        $news->title_hindi        = $request->input('title_hindi');
        $news->description_hindi  = $request->input('description_hindi');
        $news->news_date    = $request->input('news_date');
        $file = $request->file('feature_img');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "news";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/news'), $filenew);
            $news->feature_img   = asset('/uploads/news/'.$filenew);
        }
        $news->status = $request->input('status');
        $res = $news->save();

        if($res){
            $files = $request->file('news_images');
            if($files){
                $img_extra = [];
                foreach($files as $file){
                    $row = [];
                    $filename   = $file->getClientOriginalName();
                    $name       = "news_ext";
                    $extension  = $file->extension();
                    $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                    $file->move(base_path('/public/uploads/news'), $filenew);
                    $row['news_id'] = $news->id;
                    $row['title']   = $filename;
                    $row['news_img'] = asset('/uploads/news/'.$filenew);
                    $img_extra[] = $row;
                }
                NewsImage::insert($img_extra);
                return ['status' => true, 'code' => 200, 'data'=>$news];
            }else{
                return ['status' => false, 'code' => 500, 'message'=>'something went wrong with database.'];
            }
        }else{
            return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNews(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'news_date' => 'required',
            'feature_img' => 'mimes:jpeg,jpg,png,gif|required'
        ]);
        // dd($request->all());
        $news = new News;
        $news->title        = $request->input('title');
        $news->description  = $request->input('description');
        $news->title_hindi  = $request->input('title_hindi');
        $news->description_hindi  = $request->input('description_hindi');
        $news->news_date    = $request->input('news_date');
        $file = $request->file('feature_img');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "news";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/news'), $filenew);
            $news->feature_img   = asset('/uploads/news/'.$filenew);
        }
        $news->status = $request->input('status');
        $res = $news->save();
        if($res){
            return redirect(route('admin.news.index'))->with('success', __('The news has been successfully added'));
        }else{
            return redirect(route('admin.news.index'))->with('fail', __('Something went wrong'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('admin/news/show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        if($news){
            $data = ['status' => true, 'code' => 200, 'data'=>$news];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function editNews(News $news)
    {
        if($news){
            return view('admin/news/edit', compact('news'));
        }else{
            return redirect(route('admin.news.index'))->with('fail', __('The news not found'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $news = News::find($id);
        if($news){
            $news->title = $request->input('title');
            $news->description  = $request->input('description');
            $news->title_hindi        = $request->input('title_hindi');
            $news->description_hindi  = $request->input('description_hindi');
            $news->news_date    = $request->input('news_date');
            $file = $request->file('feature_img');
            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "news";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/news'), $filenew);
                $news->feature_img   = asset('/uploads/news/'.$filenew);
            }
            $news->status = $request->input('status');
            $res = $news->save();
            if($res){
                $files = $request->file('news_images');
                if($files){
                    $img_extra = [];
                    foreach($files as $file){
                        $row = [];
                        $filename   = $file->getClientOriginalName();
                        $name       = "news_ext";
                        $extension  = $file->extension();
                        $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                        $file->move(base_path('/public/uploads/news'), $filenew);
                        $row['news_id'] = $news->id;
                        $row['title']   = $filename;
                        $row['news_img'] = asset('/uploads/news/'.$filenew);
                        $img_extra[] = $row;
                    }
                    NewsImage::insert($img_extra);
                }
                return ['status' => true, 'code' => 200, 'data'=>$news];
            }else{
                return ['status' => false, 'code' => 500, 'message'=>'something went wrong with database.'];
            }
            return ['status' => true, 'code' => 200, 'data'=>$news];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function updateNews(Request $request, News $news)
    {
        // Validation
        $file   = $request->file('feature_img');
        $rules  = [
            'title'         => 'required|max:255',
            'description'   => 'required',
        ];
        if($file){
            $rules['feature_img'] = 'mimes:jpeg,jpg,png,gif|required';
        }
        $request->validate($rules);
        
        // dd($news);
        if($news){
            $news->title = $request->input('title');
            $news->description  = $request->input('description');
            $news->title_hindi        = $request->input('title_hindi');
            $news->description_hindi  = $request->input('description_hindi');
            $news->news_date    = $request->input('news_date');
            $file = $request->file('feature_img');
            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "news";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/news'), $filenew);
                $news->feature_img   = asset('/uploads/news/'.$filenew);
            }
            $news->status = $request->input('status');
            $res = $news->save();
            if($res){
                return redirect(route('admin.news.index'))->with('success', __('The news has been successfully updated'));
            }else{
                return redirect(route('admin.news.index'))->with('fail', __('something went wrong in database.'));
            }
        }else{
            return redirect(route('admin.news.index'))->with('fail', __('The data not found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        if($news){
            $news->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$news];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
