<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\DriverTracking;
use App\Models\EbillShipping;
// Datatables
use DB;
use DataTables;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $drivers = Driver::all();
        // dd($drivers);
        return view('admin.drivers.index');
    }
    public function driverData(Request $request){
        $drivers = Driver::select('drivers.*');

        return DataTables::of($drivers)
                ->addColumn('profile_image', function ($drivers) {
                    return '<img src="'.$drivers->profile_image.'" alt="'.$drivers->name.'" height="50" >';
                })
                ->addColumn('type', function ($drivers) {
                    return ($drivers->driver_type == 1) ? "<span class='badge bg-danger'>Non-Agro</span>" : "<span class='badge bg-success'>Agro</span>";
                })
                ->addColumn('status', function ($drivers) {
                    return ($drivers->status == 0) ? "<span class='badge bg-danger'>Inactive</span>" : "<span class='badge bg-success'>Active</span>";
                })
                ->addColumn('action', function ($drivers) {
                    $btn_html = '';
                    $btn_html = $btn_html.'<a class="btn btn-xs btn-info" href="'.route('admin.drivers.show', $drivers).'" role="button" title="Show"><i class="fas fa-eye"></i></a>&nbsp';
                    $btn_html = $btn_html.'<a class="btn btn-xs btn-success ajax-edit" href="'.route('admin.drivers.edit', $drivers).'" role="button" title="Edit"><i class="fas fa-pencil-alt"></i></a>&nbsp';
                    $btn_html = $btn_html.'<a class="btn btn-xs btn-danger ajax-delete" href="'.route('admin.drivers.destroy', $drivers).'" role="button" title="Delete" data-menu_id="{{$drivers->id}}"><i class="fas fa-trash-alt"></i></a>';
                    return $btn_html;
                })
                ->filter(function ($query) use ($request) {
                    // filter for title
                    if ($request->input('name') != '') {
                        $query->where('name', 'like', "%{$request->input('name')}%");
                    }
                    // filter for mobile
                    if ($request->input('mobile') != '') {
                        $query->where('mobile', 'like', "%{$request->input('mobile')}%");
                    }
                    // filter for status
                    if ($request->input('type') != '') {
                        $query->where('driver_type', $request->input('type'));
                    }
                })
                ->rawColumns(['status', 'type', 'action', 'profile_image'])
                ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function driverTrackingList()
    {
        $data = [];
        $drivers_trackings = DriverTracking::where('is_delivered', 0)->groupBy('driver_id')->get();
        // dd($drivers_trackings);
        return view('admin.drivers.driver_tracking', compact('drivers_trackings'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function driverShippingList()
    {
        $data = [];
        $drivers_trackings = EbillShipping::where('is_delivered', 0)->groupBy('driver_id')->get();
        // dd($drivers_trackings);
        return view('admin.drivers.driver_tracking', compact('drivers_trackings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // if request is send by ajax
        if ($request->ajax()) {
            return view('admin/drivers/create' )->render();
        }
        return view('admin/drivers/create' );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function driverShippingCreate(Request $request)
    {
        // if request is send by ajax
        if ($request->ajax()) {
            return view('admin/drivers/add_shipping' )->render();
        }
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
            'name' => 'required|max:255',
            'mobile' => 'required|max:255',
            'password' => 'required|min:6',
            'profile_image' => 'mimes:jpeg,jpg,png|required'
        ]);
        $driver = new Driver;
        $driver->name   = $request->input('name');
        $driver->user_name   = strtolower(str_replace(' ', '', $request->input('name')));
        $driver->mobile = $request->input('mobile');
        $driver->password = md5($request->input('password'));
        $driver->conf_password = $request->input('password');
        $driver->driver_type = 2;
        $file           = $request->file('profile_image');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "driver";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/driver'), $filenew);
            $driver->profile_image   = asset('/uploads/driver/'.$filenew);
        }
        $driver->status = $request->input('status');
        $res = $driver->save();
        
        if ($request->ajax()) {
            return response()->json([
                'success'=>'The driver has been successfully added.'
            ]);
        }
        return redirect(route('admin.drivers'))->with('driver-ok', __('The driver has been successfully added'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function driverShippingStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'shipping_id' => 'required',
        ]);
        $driver = new Driver;
        $driver->name   = $request->input('name');
        $driver->user_name   = strtolower(str_replace(' ', '', $request->input('name')));
        $driver->mobile = $request->input('mobile');
        $driver->password = md5($request->input('password'));
        $driver->conf_password = $request->input('password');
        $driver->driver_type = 2;
        $file           = $request->file('profile_image');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "driver";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/driver'), $filenew);
            $driver->profile_image   = asset('/uploads/driver/'.$filenew);
        }
        $driver->status = $request->input('status');
        $res = $driver->save();
        
        if ($request->ajax()) {
            return response()->json([
                'success'=>'The driver has been successfully added.'
            ]);
        }
        return redirect(route('admin.drivers'))->with('driver-ok', __('The driver has been successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        if($driver){
            $ebill_shippings = EbillShipping::where('driver_id', $driver->id)->get();
            return view('admin/drivers/show', compact('driver', 'ebill_shippings'));
        }else{
            return redirect(route('admin.drivers'))->with('driver-fail', __('Driver not found'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Driver $driver)
    {
        if($driver){
            if ($request->ajax()) {
                return view('admin/drivers/edit', compact('driver'))->render();
            }
            return view('admin/drivers/edit', compact('driver'));
        }else{
            return redirect(route('admin.drivers.index'))->with('fail', __('Driver not found'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        // dd($driver);
        // Validation
        $file   = $request->file('profile_image');
        $rules  = [
            'name' => 'required|max:255',
            'mobile' => 'required|max:255',
            'password' => 'required|min:6',
        ];
        if($file){
            $rules['profile_image'] = 'mimes:jpeg,jpg,png|required';
        }
        
        $request->validate($rules);

        if($driver){
            $driver->name   = $request->input('name');
            $driver->user_name   = strtolower(str_replace(' ', '', $request->input('name')));
            $driver->mobile = $request->input('mobile');
            $driver->password = md5($request->input('password'));
            $driver->conf_password = $request->input('password');
            $driver->driver_type = 2;
            $file           = $request->file('profile_image');
            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "driver";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/driver'), $filenew);
                $driver->profile_image   = asset('/uploads/driver/'.$filenew);
            }
            $driver->status = $request->input('status');
            $res = $driver->save();
            if($res){
                if ($request->ajax()) {
                    return response()->json([
                        'success'=>'The driver has been successfully updated.'
                    ]);
                }
                return redirect(route('admin.drivers.index'))->with('success', 'The Driver has been successfully updated');
            }else{
                if ($request->ajax()) {
                    return response()->json([
                        'fail'=>'something Went wrong please try again.'
                    ]);
                }
                return redirect(route('admin.drivers.index'))->with('fail', 'something Went wrong please try again.');
            }
        }else{
            if ($request->ajax()) {
                return response()->json([
                    'fail'=>'Driver Not Found.'
                ]);
            }
            return redirect(route('admin.drivers.index'))->with('fail', __('Driver not found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        if($driver){
            $driver->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$driver];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
