<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryList()
    {
        $data = [];
        $categories = Category::where('parent', 0)->get();
        if($categories){
            $data = ['status' => true, 'code' => 200, 'data'=>$categories];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }
    /**
     * Display a listing of the sub categories.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subCategorylist()
    {
        $data = [];
        $sub_categories = Category::with('parent')->where('parent', '!=' ,'0')->get();
        if(count($sub_categories)){
            $data = ['status' => true, 'code' => 200, 'data'=>$sub_categories];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
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
        $category = new Category;
        $category->parent = 0;
        $category->title = $request->input('title');
        $category->slug = $request->input('slug');
        $file = $request->file('icon');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "icon";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/icon'), $filenew);
            $category->icon   = asset('/uploads/icon/'.$filenew);
        }
        $category->status = $request->input('status');
        $category->save();
        return ['status' => true, 'code' => 200, 'data'=>$category];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if($category){
            $data = ['status' => true, 'code' => 200, 'data'=>$category];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if($category){
            $category->parent = 0;
            $category->title = $request->input('title');
            $category->slug = $request->input('slug');
            $file = $request->file('icon');
            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "icon";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/icon'), $filenew);
                $category->icon   = asset('/uploads/icon/'.$filenew);
            }
            $category->status = $request->input('status');
            $category->save();
            return ['status' => true, 'code' => 200, 'data'=>$category];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$category];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
