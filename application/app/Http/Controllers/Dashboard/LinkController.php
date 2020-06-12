<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Link;
use Illuminate\Support\Facades\Cache;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $links = Cache::rememberForever('links', function() {
            return Link::all();
        });

        return view('links.index', compact('links'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'bail|required|max:255',
            'url' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            alert()
                ->error('Oops!','Looks like something went wrong, please review what you\'re trying to submit and try again.')
                ->footer('If this issue continues, please contact support.')
                ->showCloseButton('aria-label')
                ->showConfirmButton('Ok, got it','#3085d6')
                ->autoClose(10000);
            return back()->withInput()->withErrors($validator);
        }

        Link::create([
            'title' => $request->title,
            'url' => $request->url,
            'fa_icon' => $request->fa_icon,
            'new_tab' => $request->new_tab
        ]);
        Cache::forget('links');
        toast('Link Edited Successfully!','success','top-right');
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Link $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link){
        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Models\Link $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link){
        $validator = Validator::make($request->all(), [
            'title' => 'bail|required|max:255',
            'url' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            alert()
                ->error('Oops!','Looks like something went wrong, please review what you\'re trying to submit and try again.')
                ->footer('If this issue continues, please contact support.')
                ->showCloseButton('aria-label')
                ->showConfirmButton('Ok, got it','#3085d6')
                ->autoClose(10000);
            return back()->withInput();
        }

        $link->fill($request->input())->save();
        Cache::forget('links');
        toast('Link Edited Successfully!','success','top-right');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link $link
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Link $link){
        $link->delete();
        Cache::forget('links');
        toast('Link Edited Successfully!','success','top-right');
        return redirect(route('dashboard.links'));
    }
}
