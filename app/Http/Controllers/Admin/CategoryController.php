<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource for web.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $categories = Category::with('parent')->get();
        // dd($categories);
        return view('admin.categories.index', compact('categories'));
    }
    /**
     * Display a listing of the resource for api.
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
        $sub_categories = Category::where('parent', '!=' ,'0')->get();
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
    public function createCategory(Request $request)
    {
        // if request is send by ajax
        if ($request->ajax()) {
            return view('admin/categories/create')->render();
        }
        return view('admin/categories/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSubcategory(Request $request)
    {
        $categories = Category::where('parent',0)->get();
        // if request is send by ajax
        if ($request->ajax()) {
            return view('admin/categories/create_subcategory', compact('categories') )->render();
        }
        return view('admin/categories/create_subcategory', compact('categories') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'title_hindi' => 'required|max:255',
            'slug' => 'required|max:255',
            'icon' => 'mimes:jpeg,jpg,png,gif|required'
        ]);

        $category = new Category;
        $category->parent = $request->input('parent');
        $category->title = $request->input('title');
        $category->title_hindi = $request->input('title_hindi');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'title'     => 'required|max:255',
            'title_hindi' => 'required|max:255',
            'slug' => 'required|max:255',
            'icon' => 'mimes:jpeg,jpg,png,gif|required'
        ]);
        $category = new Category;
        $category->parent = $request->input('parent');
        $category->title = $request->input('title');
        $category->title_hindi = $request->input('title_hindi');
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
        
        if ($request->ajax()) {
            return response()->json([
                'success'=>'The category has been successfully added.'
            ]);
        }
        return redirect(route('admin.categories'))->with('category-ok', __('The category has been successfully added'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSubCategory(Request $request)
    {
        $request->validate([
            'parent'    => 'required',
            'title'     => 'required|max:255',
            'title_hindi' => 'required|max:255',
            'slug' => 'required|max:255',
            'icon' => 'mimes:jpeg,jpg,png,gif|required'
        ]);
        $category = new Category;
        $category->parent = $request->input('parent');
        $category->title = $request->input('title');
        $category->title_hindi = $request->input('title_hindi');
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
        if ($request->ajax()) {
            return response()->json([
                'success'=>'The subcategory has been successfully added.'
            ]);
        }
        return redirect(route('admin.categories'))->with('category-ok', __('The subcategory has been successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCategory(Request $request, Category $category)
    {
        if ($request->ajax()) {
            return view('admin/categories/edit', compact('category'))->render();
        }
        return view('admin/categories/edit', compact('category'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSubCategory(Request $request, Category $subcategory)
    {
        $categories = Category::where('parent',0)->get();
        if ($request->ajax()) {
            return view('admin/categories/edit_subcategory', compact('categories', 'subcategory'))->render();
        }
        return view('admin/categories/edit_subcategory', compact('categories', 'subcategory'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(Request $request, Category $category){
        // Validation
        $file   = $request->file('icon');

        $rules  = [
            'title' => 'required|max:255',
            'title_hindi' => 'required|max:255',
            'slug' => 'required|max:255',
        ];
        if($file){
            $rules['icon'] = 'mimes:jpeg,jpg,png,gif|required';
        }

        $request->validate($rules);
        
        if($category):
            $data = $request->all();
            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "icon";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/icon'), $filenew);
                $data['icon']   = asset('/uploads/icon/'.$filenew);
            }
            $category->update($data);
            // if request is send by ajax
            if ($request->ajax()) {
                return response()->json([
                    'success'=>'The category has been successfully updated.'
                ]);
            }
            return redirect(route('admin.categories'))->with('category-ok', __('The category has been successfully updated'));
        else:
            return response()->json([
                'danger'=>'Something went wrong.'
            ]);   
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSubCategory(Request $request, Category $subcategory){
        // Validation
        $file   = $request->file('icon');

        $rules  = [
            'title' => 'required|max:255',
            'title_hindi' => 'required|max:255',
            'slug' => 'required|max:255',
        ];
        if($file){
            $rules['icon'] = 'mimes:jpeg,jpg,png,gif|required';
        }

        $request->validate($rules);

        if($subcategory):
            $data = $request->all();
            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "icon";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/icon'), $filenew);
                $data['icon']   = asset('/uploads/icon/'.$filenew);
            }
            $subcategory->update($data);
            // if request is send by ajax
            if ($request->ajax()) {
                return response()->json([
                    'success'=>'The subcategory has been successfully updated.'
                ]);
            }
            return redirect(route('admin.categories'))->with('category-ok', __('The subcategory has been successfully updated'));
        else:
            return response()->json([
                'danger'=>'Something went wrong.'
            ]);   
        endif;
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
            $category->parent = $request->input('parent');
            $category->title = $request->input('title');
            $category->title_hindi = $request->input('title_hindi');
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
