<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $features = Cache::rememberForever('features', function() {
            return Feature::all();
        });
        return view('features.index', compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'bail|required|min:3|max:255',
        ]);

        if ($validator->fails()) {
            alert()
                ->error('Oops!','Looks like your title is too short, please try again.')
                ->footer('If this issue continues, please contact support.')
                ->showCloseButton('aria-label')
                ->showConfirmButton('Ok, got it','#3085d6')
                ->autoClose(10000);
            return back()->withInput();
        }

        Feature::create([
            'title' => $request->title,
            'description' => $request->description,
            'img_url' => $request->img_url,
            'fa_icon' => $request->fa_icon,
            'fa_color' => $request->fa_color,
            'display' => $request->display,
        ]);
        Cache::forget('features');
        toast('Feature Created Successfully!','success','top-right');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Feature $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature){
        return view('features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Feature $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature){
        $validator = Validator::make($request->all(), [
            'title' => 'bail|required|min:5|max:255',
        ]);

        if ($validator->fails()) {
            alert()
                ->error('Oops!','Looks like something wen\'t wrong, please review what you\'re trying to submit and try again.')
                ->footer('If this issue continues, please contact support.')
                ->showCloseButton('aria-label')
                ->showConfirmButton('Ok, got it','#3085d6')
                ->autoClose(10000);
            return back()->withInput();
        }

        $feature->fill($request->input())->save();
        Cache::forget('features');
        toast('Feature Edited Successfully!','success','top-right');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Feature $feature
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Feature $feature){
        $feature->delete();
        Cache::forget('features');
        toast('Feature Deleted Successfully!','success','top-right');
        return redirect(route('dashboard.features'));
    }
}
