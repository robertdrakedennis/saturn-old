<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\CurrentTheme;
use App\Models\Themes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ThemesController extends Controller{
    public function index(){
        $allThemes = Themes::all();

        $currentTheme = Cache::rememberForever('currentTheme', function() {
            return CurrentTheme::first();
        });

        return view('themes.index', compact('allThemes', 'currentTheme'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Themes $themes
     * @return \Illuminate\Http\Response
     */
    public function edit(Themes $themes){

        $allThemes = Themes::all();

        $currentTheme = Cache::rememberForever('currentTheme', function() {
            return CurrentTheme::first();
        });

        return view('themes.edit', compact('currentTheme', 'allThemes', 'themes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Models\Themes $themes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Themes $themes){
        $currentTheme = CurrentTheme::first();

        $newTheme = Themes::findOrFail($request->theme);


        if ($currentTheme->currentTheme == $request->newTheme){
            alert()
                ->warning('Wait!', 'You\'ve already set this theme! Try using a different one.')
                ->showCloseButton('aria-label')
                ->showConfirmButton('Ok, got it','#3085d6')
                ->autoClose(10000);
            return back()->withInput();
        } else

        $currentTheme->currentTheme()->associate($newTheme)->save();

        Cache::forget('currentTheme');

        alert()->success('Theme Set Successfully!', 'Your changes will show soon!')
            ->showCloseButton('aria-label')
            ->showConfirmButton('Ok, got it','#3085d6')
            ->autoClose(10000);
        return back();
    }
}
