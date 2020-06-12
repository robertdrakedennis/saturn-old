<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Team;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = Cache::rememberForever('users', function() {
            return User::all();
        });

        $teams = Cache::rememberForever('teams', function() {
            return Team::all();
        });

        return view('team.index', compact('users', 'teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|min:1|max:255',
        ]);

        if ($validator->fails()) {
            alert()
                ->error('Oops!','Looks like something wen\'t wrong, please review what you\'re trying to submit and try again.')
                ->footer('If this issue continues, please contact support.')
                ->showCloseButton('aria-label')
                ->showConfirmButton('Ok, got it','#3085d6')
                ->autoClose(10000);
            return back()->withInput()->withErrors($validator);
        }

        Team::create([
            'name' => $request->name,
            'description' => $request->description,
            'img_url' => $request->img_url,
            'fa_icon' => $request->fa_icon,
            'fa_color' => $request->fa_color,
            'display' => $request->display,
        ]);

        Cache::forget('teams');

        toast('Team Created Successfully!','success','top-right');
        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team){
        return view('team.edit', compact('team'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Models\Team $team
    * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team){
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|min:5|max:255',
        ]);

        if ($validator->fails()) {
            alert()
                ->error('Oops!','Looks like something wen\'t wrong, please review what you\'re trying to submit and try again.')
                ->footer('If this issue continues, please contact support.')
                ->showCloseButton('aria-label')
                ->showConfirmButton('Ok, got it','#3085d6')
                ->autoClose(10000);
            return back()->withInput();
        } else

            $team->fill($request->input())->save();
        Cache::forget('teams');
        toast('Server Edited Successfully!','success','top-right');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Team $team){
        $team->delete();
        Cache::forget('teams');
        toast('Server Edited Successfully!','success','top-right');
        // incase they're deleting from the edit route.
        return redirect(route('dashboard.team'));
    }
}
