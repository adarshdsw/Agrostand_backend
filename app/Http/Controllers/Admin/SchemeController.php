<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scheme;
use App\Models\SchemeImage;
use Illuminate\Http\Request;
// notification
use App\Notifications\NewSchemeCreated;
use App\Models\User;
// Datatables
use DB;
use DataTables;

class SchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offset = 0;
        $limit  = 10;
        $data = [];
        $schmes = Scheme::where('status', '1')->offset($offset)->limit($limit)->orderBy('id', 'DESC')->get();
        $total_count = Scheme::where('status', '1')->count();
        if(count($schmes)){
            $data = ['status' => true, 'code' => 200, 'data'=>$schmes, 'total_count'=>$total_count];
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
    public function schemeList()
    {
        return view('admin.schemes.index');
    }
    /**
     * Get scheme datatable data
     *
     *
     */
    public function schemeData(Request $request){
        // get news specific column for datatable
        $schmes = Scheme::select(['id', 'feature_img', 'title', 'title_hindi', 'description', 'scheme_date', 'status', 'created_at']);
        // dd($schmes);
        return DataTables::of($schmes)
                ->addColumn('feature_img', function ($schmes) {
                    return '<a href="'.$schmes->feature_img.'" data-toggle="lightbox" ><img src="'.$schmes->feature_img.'" alt="" height="50" ></a>';
                })
                ->addColumn('status', function ($schmes) {
                    return ($schmes->status == 0) ? "<span class='badge bg-danger'>Inactive</span>" : "<span class='badge bg-success'>Active</span>";
                })
                ->addColumn('action', function ($schmes) {
                    $btn_html = '';
                    $btn_html = $btn_html.'<a class="btn btn-xs btn-info" href="'.route('admin.scheme.show', $schmes).'" role="button" title="View"><i class="fas fa-eye"></i></a>&nbsp;';
                    $btn_html = $btn_html.'<a class="btn btn-xs btn-success" href="'.route('admin.scheme.edit', $schmes).'" role="button" title="Edit"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                    $btn_html = $btn_html.'<a class="btn btn-xs btn-danger ajax-delete" href="'.route('admin.scheme.delete', $schmes).'" role="button" title="Delete" data-programme_id="'.$schmes->id.'"><i class="fas fa-trash"></i></a>&nbsp;';
                    return $btn_html;
                })
                ->filter(function ($query) use ($request) {
                    // filter for title
                    if ($request->input('title') != '') {
                        $query->where('title', 'like', "%{$request->input('title')}%");
                    }
                    // filter for status
                    if ($request->input('status') != '') {
                        $query->where('status', $request->input('status'));
                    }
                })
                ->rawColumns(['status', 'action', 'feature_img'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schemes.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $scheme = new Scheme;
        $scheme->title        = $request->input('title');
        $scheme->description  = $request->input('description');
        $scheme->title_hindi        = $request->input('title_hindi');
        $scheme->description_hindi  = $request->input('description_hindi');
        $scheme->scheme_date  = $request->input('scheme_date');
        $file = $request->file('feature_img');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "scheme";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/scheme'), $filenew);
            $scheme->feature_img   = asset('/uploads/scheme/'.$filenew);
        }
        $scheme->status = $request->input('status');
        $scheme_id = $scheme->save();

        if($scheme_id){
            $files = $request->file('scheme_images');
            if($files){
                $img_extra = [];
                foreach($files as $file){
                    $row = [];
                    $filename   = $file->getClientOriginalName();
                    $name       = "scheme_ext";
                    $extension  = $file->extension();
                    $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                    $file->move(base_path('/public/uploads/scheme'), $filenew);
                    $row['scheme_id'] = $scheme->id;
                    $row['title']   = $filename;
                    $row['scheme_img'] = asset('/uploads/scheme/'.$filenew);
                    $img_extra[] = $row;
                }
                SchemeImage::insert($img_extra);
            }
            return ['status' => true, 'code' => 200, 'data'=>$scheme];
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
    public function storeScheme(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'scheme_date' => 'required',
            'feature_img' => 'mimes:jpeg,jpg,png,gif|required'
        ]);
        $scheme = new Scheme;
        $scheme->title        = $request->input('title');
        $scheme->description  = $request->input('description');
        $scheme->title_hindi        = $request->input('title_hindi');
        $scheme->description_hindi  = $request->input('description_hindi');
        $scheme->scheme_date  = $request->input('scheme_date');
        $file = $request->file('feature_img');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "scheme";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/scheme'), $filenew);
            $scheme->feature_img   = asset('/uploads/scheme/'.$filenew);
        }
        $scheme->status = $request->input('status');
        // dd($scheme);
        $res = $scheme->save();

        if($res){
            // list of all users
            /*$users = User::where('status','1')->get();
            // if users are not empty
            if(!empty($users)){
                foreach($users as $user){
                    try{
                        $user->notify(new NewSchemeCreated($scheme));
                    }catch(Exception $e){
                        report($e);
                        return false;
                    }
                }
            }*/
            return redirect(route('admin.scheme.index'))->with('success', __('The Scheme has been successfully added'));
        }else{
            return redirect(route('admin.scheme.index'))->with('fail', __('Something went wrong'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function show(Scheme $scheme)
    {
        return view('admin/schemes/show', compact('scheme'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scheme = Scheme::find($id);
        if($scheme){
            $data = ['status' => true, 'code' => 200, 'data'=>$scheme];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function editScheme(Scheme $scheme)
    {
        if($scheme){
            return view('admin/schemes/edit', compact('scheme'));
        }else{
            return redirect(route('admin.scheme.index'))->with('fail', __('The scheme not found'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $scheme = Scheme::find($id);
        if($scheme){
            $scheme->title = $request->input('title');
            $scheme->description  = $request->input('description');
            $scheme->title_hindi        = $request->input('title_hindi');
            $scheme->description_hindi  = $request->input('description_hindi');
            $scheme->scheme_date    = $request->input('scheme_date');
            $file = $request->file('feature_img');
            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "scheme";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/scheme'), $filenew);
                $scheme->feature_img   = asset('/uploads/scheme/'.$filenew);
            }
            $scheme->status = $request->input('status');
            $res = $scheme->save();
            if($res){
                $files = $request->file('scheme_images');
                if($files){
                    $img_extra = [];
                    foreach($files as $file){
                        $row = [];
                        $filename   = $file->getClientOriginalName();
                        $name       = "scheme_ext";
                        $extension  = $file->extension();
                        $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                        $file->move(base_path('/public/uploads/scheme'), $filenew);
                        $row['scheme_id'] = $scheme->id;
                        $row['title']   = $filename;
                        $row['scheme_img'] = asset('/uploads/scheme/'.$filenew);
                        $img_extra[] = $row;
                    }
                    SchemeImage::insert($img_extra);
                }
                return ['status' => true, 'code' => 200, 'data'=>$scheme];
            }else{
                return ['status' => false, 'code' => 500, 'message'=>'something went wrong with database.'];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function updateScheme(Request $request, Scheme $scheme)
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

        if($scheme){
            $scheme->title = $request->input('title');
            $scheme->description  = $request->input('description');
            $scheme->title_hindi        = $request->input('title_hindi');
            $scheme->description_hindi  = $request->input('description_hindi');
            $scheme->scheme_date    = $request->input('scheme_date');
            $file = $request->file('feature_img');
            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "scheme";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/scheme'), $filenew);
                $scheme->feature_img   = asset('/uploads/scheme/'.$filenew);
            }
            $scheme->status = $request->input('status');
            $res = $scheme->save();
            if($res){
                return redirect(route('admin.scheme.index'))->with('success', __('The Scheme has been successfully updated'));
            }else{
                return redirect(route('admin.scheme.index'))->with('fail', __('Something went wrong'));
            }
        }else{
            return redirect(route('admin.scheme.index'))->with('fail', __('Data not found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scheme = Scheme::find($id);
        if($scheme){
            $scheme->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$scheme];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
