<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggestions = Suggestion::all();
        // dd($suggestions);
        return view('admin.suggestions.index', compact('suggestions'));
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
            return view('admin/suggestions/create' )->render();
        }
        return view('admin/suggestions/create' );
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
            'type' => 'required',
        ]);
        $suggestion = new Suggestion;
        $suggestion->title       = $request->input('title');
        $suggestion->title_hindi = ($request->input('title_hindi')) ? $request->input('title_hindi') : '';
        $suggestion->type        = $request->input('type');
        $res = $suggestion->save();
        if ($request->ajax()) {
            return response()->json([
                'success'=>'The Suggestion has been successfully added.'
            ]);
        }
        return redirect(route('admin.suggestions'))->with('ok', __('The Suggestion has been successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suggestion  $suggestion
     * @return \Illuminate\Http\Response
     */
    public function show(Suggestion $suggestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suggestion  $suggestion
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Suggestion $suggestion)
    {
        if($suggestion){
            if ($request->ajax()) {
                return view('admin/suggestions/edit', compact('suggestion'))->render();
            }
            return view('admin/suggestions/edit', compact('suggestion'));
        }else{
            return redirect(route('admin.suggestions.index'))->with('fail', __('Suggestion not found'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suggestion  $suggestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suggestion $suggestion)
    {
        // Validation
        $rules  = [
            'title'         => 'required|max:255',
            'type' => 'required',
        ];

        $request->validate($rules);

        if($suggestion){
            $suggestion->title        = $request->input('title');
            $suggestion->title_hindi  = ($request->input('title_hindi')) ? $request->input('title_hindi') : '';
            $suggestion->type       = $request->input('type');
            // dd($suggestion);
            $res = $suggestion->save();
            if($res){
                if ($request->ajax()) {
                    return response()->json([
                        'success'=>'The Suggestion has been successfully updated.'
                    ]);
                }
                return redirect(route('admin.suggestions.index'))->with('success', 'The Suggestion has been successfully updated');
            }else{
                if ($request->ajax()) {
                    return response()->json([
                        'fail'=>'something Went wrong please try again.'
                    ]);
                }
                return redirect(route('admin.suggestions.index'))->with('fail', 'something Went wrong please try again.');
            }
        }else{
            if ($request->ajax()) {
                return response()->json([
                    'fail'=>'Suggestion Not Found.'
                ]);
            }
            return redirect(route('admin.suggestions.index'))->with('fail', __('Suggestion not found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suggestion  $suggestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suggestion $suggestion)
    {
        if($suggestion){
            $suggestion->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$suggestion];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }

    public function suggestionList(Request $request){
        
        $offset  = $request->input('offset');
        $limit   = $request->input('limit');
        $search_str = ($request->input('search_str'))?$request->input('search_str'):'';
        if($search_str != ''){
            $suggestions = Suggestion::where('title', 'like', $search_str.'%')->offset($offset)->limit($limit)->orderBy('title', 'ASC')->get();
        }else{
            $suggestions = Suggestion::offset($offset)->limit($limit)->orderBy('title', 'ASC')->get();
        }

        $total_count = Suggestion::where('title', 'like', $search_str.'%')->count();
        
        if($suggestions){
            $data = ['status' => true, 'code' => 200, 'suggestions' => $suggestions, 'total_count'=>$total_count];
        }else{
            $data = ['status' => false, 'code' => 500];
        }
        return $data;
    }
}
