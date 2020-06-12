<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\SteamApi;
use App\Models\Team;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    private static $sapi_gps_url = 'https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=%s&steamids=%s';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::paginate(15);
        return view('users.index', compact('users'));
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user){
        $teams = Team::all();
        return view('users.show', compact('user', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\
     */
    public function update(Request $request, User $user){

        if (is_numeric($request->team_id)) {
            $team = Team::findOrFail($request->team_id);
        }

        $validator = Validator::make($request->all(), [
            'name' => [
                'nullable',
                'min:5',
                'max:255',
                Rule::unique('users')->ignore($user)
            ],
            'team_id' => 'nullable',
            'role' => 'nullable',
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

        if ($request->name != null){
            $user->name = $request->name;
        }

        if (is_numeric($request->team_id)) {
            $user->team()->associate($team);
            Cache::forget('teams');
        }

        if ($request->role !== null){
            if($request->role === 'user'){
                $user->syncRoles([$request->role]);
            } else {
                $user->syncRoles([$request->role]);
            }
        }

        $user->save();
        Cache::forget('users');
        toast('User Updated Successfully!','success','top-right');
        return back();
    }

    /**
     * Remove the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function removeTeam(Request $request, User $user){

        $user->team()->dissociate();
        $user->save();
        Cache::forget('users');
        Cache::forget('teams');
        toast('Team Removed Successfully!','success','top-right');
        return back();
    }

    /**
     * Sync avatar with steam
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function syncWithSteam(User $user){

        $steamApi = SteamApi::first();

        if ($steamApi->api_key !== null){
            $fetch = file_get_contents(sprintf(static::$sapi_gps_url, $steamApi->api_key, $user->steamid));
            $decode = json_decode($fetch, true);
            $steam = $decode["response"]["players"][0];

            $user->name = $steam['personaname'];
            $user->avatar = $steam['avatarfull'];
            $user->save();
            Cache::forget('users');
            toast('User synced with Steam Successfully!','success','top-right');
            return back();
        } else {
            toast('You need to specify a steam api key.','error','top-right');
            return back();
        }
    }

    /**
     * Remove the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $steamApi = SteamApi::first();

        if ($steamApi->api_key !== null) {

            try {
                $fetch = file_get_contents(sprintf(static::$sapi_gps_url, $steamApi->api_key, $request->steamid));
                $decode = json_decode($fetch, true);
                $steam = $decode["response"]["players"][0];

                User::create([
                    'name' => $steam['personaname'],
                    'steamid' => $steam['steamid'],
                    'avatar' => $steam['avatarfull'],
                ]);

                Cache::forget('users');
                Cache::forget('teams');
                toast('User Added Successfully!', 'success', 'top-right');
                return back();
            } catch (\Exception $e) {
                alert()
                    ->error('Oops!', "It looks like your Steam API key OR your steamid is invalid. Please double check that you've entered it correctly.")
                    ->footer('Need help? Contact support!')
                    ->showCloseButton('aria-label')
                    ->showConfirmButton('Ok, got it', '#3085d6')
                    ->autoClose(10000);
                return back()->withInput();
            }
        } else {
            toast('You need to specify a steam api key.','error','top-right');
            return back();
        }
    }
}
