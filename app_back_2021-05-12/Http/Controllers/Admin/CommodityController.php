<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\Category;
use DataTables;

class CommodityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $commodities = Commodity::with('subcategory')->get();
        if(count($commodities)){
            $data = ['status' => true, 'code' => 200, 'data'=>$commodities];
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
    public function commodityList()
    {
        $data = [];
        $commodities = Commodity::with('subcategory')->get();
        return view('admin.commodities.index', compact('commodities'));
    }

    public function commodityData(Request $request){
        $commodities = Commodity::with(['subcategory'])->select('commodities.*');

        return DataTables::of($commodities)
                ->addColumn('icon', function ($commodities) {
                    return '<img src="'.$commodities->icon.'" alt="'.$commodities->title.'" height="50" >';
                })
                ->addColumn('status', function ($commodities) {
                    return ($commodities->status == 0) ? "<span class='badge bg-danger'>Inactive</span>" : "<span class='badge bg-success'>Active</span>";
                })
                ->addColumn('action', function ($commodities) {
                    $btn_html = '';
                    $btn_html = $btn_html.'<a class="btn btn-xs btn-success ajax-edit" href="'.route('admin.commodity.edit', $commodities).'" role="button" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                    $btn_html = $btn_html.'<a class="btn btn-xs btn-danger ajax-delete" href="'.route('admin.commodity.delete', $commodities).'" role="button" title="Delete" data-menu_id="'.$commodities->id.'"><i class="fas fa-trash-alt"></i></a>';
                    return $btn_html;
                })
                ->filter(function ($query) use ($request) {
                    // filter for title
                    if ($request->input('name') != '') {
                        $query->where('name', 'like', "%{$request->input('name')}%");
                    }
                    // filter for Category
                    if ($request->input('subcategory_id') != '') {
                        $query->where('subcategory_id', $request->input('subcategory_id'));
                    }
                    // filter for status
                    if ($request->input('status') != '') {
                        $query->where('status', $request->input('status'));
                    }
                })
                ->rawColumns(['status', 'action', 'icon'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $subcategories = Category::where('parent', '!=', 0)->get();
        // if request is send by ajax
        if ($request->ajax()) {
            return view('admin/commodities/create', compact('subcategories') )->render();
        }
        return view('admin/commodities/create', compact('subcategories') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $commodity = new Commodity;
        $commodity->subcategory_id = $request->input('subcategory_id');
        $commodity->title = $request->input('title');
        $commodity->title_hindi = $request->input('title_hindi');
        $commodity->slug = $request->input('slug');
        $file = $request->file('icon');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "commodity";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/icon'), $filenew);
            $commodity->icon   = asset('/uploads/icon/'.$filenew);
        }
        $commodity->status = $request->input('status');
        $res = $commodity->save();
        if($res){
            return ['status' => true, 'code' => 200, 'data'=>$commodity];
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
    public function storeCommodity(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required',
            'title' => 'required|max:255',
            'title_hindi' => 'required|max:255',
            'slug' => 'required|max:255',
            'icon' => 'mimes:jpeg,jpg,png,gif|required'
        ]);
        $commodity = new Commodity;
        $commodity->subcategory_id = $request->input('subcategory_id');
        $commodity->title = $request->input('title');
        $commodity->title_hindi = $request->input('title_hindi');
        $commodity->slug = $request->input('slug');
        $file = $request->file('icon');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "commodity";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/icon'), $filenew);
            $commodity->icon   = asset('/uploads/icon/'.$filenew);
        }
        $commodity->status = $request->input('status');
        $res = $commodity->save();
        
        if ($request->ajax()) {
            return response()->json([
                'success'=>'The commodity has been successfully added.'
            ]);
        }
        return redirect(route('admin.commodity'))->with('commodity-ok', __('The commodity has been successfully added'));
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
        $commodity = Commodity::find($id);
        if($commodity){
            $data = ['status' => true, 'code' => 200, 'data'=>$commodity];
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
    public function editCommodity(Request $request, Commodity $commodity)
    {
        $subcategories = Category::where('parent', '!=', 0)->get();
        if($commodity){
            if ($request->ajax()) {
                return view('admin/commodities/edit', compact('commodity', 'subcategories'))->render();
            }
            return view('admin/commodities/edit', compact('commodity', 'subcategories'));
        }else{
            return redirect(route('admin.commodity.index'))->with('commodity-fail', __('Commodity not found'));
        }
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
        $commodity = Commodity::find($id);
        if($commodity){
            $commodity->subcategory_id = $request->input('subcategory_id');
            $commodity->title = $request->input('title');
            $commodity->title_hindi = $request->input('title_hindi');
            $commodity->slug = $request->input('slug');
            $file = $request->file('icon');
            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "commodity";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/icon'), $filenew);
                $commodity->icon   = asset('/uploads/icon/'.$filenew);
            }
            $commodity->status = $request->input('status');
            $commodity->save();
            return ['status' => true, 'code' => 200, 'data'=>$commodity];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCommodity(Request $request, Commodity $commodity)
    {
        // dd($request->all(), $commodity);
        // Validation
        $file   = $request->file('icon');
        $rules  = [
            'subcategory_id' => 'required',
            'title'         => 'required|max:255',
            'title_hindi'   => 'required|max:255',
            'slug'          => 'required|max:255',
        ];
        if($file){
            $rules['icon'] = 'mimes:jpeg,jpg,png,gif|required';
        }
        
        $request->validate($rules);

        if($commodity){
            $commodity->subcategory_id = $request->input('subcategory_id');
            $commodity->title = $request->input('title');
            $commodity->title_hindi = $request->input('title_hindi');
            $commodity->slug = $request->input('slug');

            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "commodity";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/icon'), $filenew);
                $commodity->icon   = asset('/uploads/icon/'.$filenew);
            }
            $commodity->status = $request->input('status');
            $res = $commodity->save();
            if($res){
                return redirect(route('admin.commodity.index'))->with('success', 'The Commodity has been successfully updated');
            }else{
                return redirect(route('admin.commodity.index'))->with('fail', 'something Went wrong please try again.');
            }
        }else{
            return redirect(route('admin.commodity.index'))->with('commodity-fail', __('Commodity not found'));
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
        $commodity = Commodity::find($id);
        if($commodity){
            $commodity->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$commodity];
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
    public function deleteCommodity(Commodity $commodity)
    {
        // dd($commodity);
        if($commodity){
            $commodity->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$commodity];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
