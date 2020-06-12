<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use kanalumaddela\LaravelSteamLogin\SteamLogin;


class SteamLoginController extends Controller
{
    /**
     * SteamLogin instance
     *
     * @var SteamLogin
     */
    protected $steam;

    /**
     * Illuminate\Http\Request
     *
     * @var Request $request
     */
    protected $request;


    /**
     * SteamLoginController constructor
     *
     * @param Request $request
     * @param SteamLogin $steam
     */
    public function __construct(Request $request, SteamLogin $steam)
    {
        $this->request = $request;
        $this->steam = $steam;
    }

    /**
     * Redirect to steam
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login()
    {
        return $this->steam->redirect();
    }

    /**
     * Validate login, get user's info, create user if they don't exist, log them in
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle()
    {
        // check if validation succeeded, returns true/false
        if ($this->steam->validate()) {

            // get player's info
            $player = $this->steam->getPlayerInfo(); // or getPlayer() if you want to authenticate only

            // get user from DB
            $user = $this->findOrNewUser($player);

            // login and remember user
            Auth::login($user, true);
        }

        // redirects the user back to the page they were on before logging in instead of redirecting to steam
        return $this->steam->return();
    }

    /**
     * Find existing user or insert one
     *
     * @param $player
     * @return mixed
     */
    protected function findOrNewUser($player)
    {
        // find user in DB, assumes your users table has a steamid column
        $user = User::where('steamid', $player->steamid)->first();

        // creates user if they don't exist
        if (is_null($user)) {
            $user = User::create([
                'name' => $player->name,
                'steamid' => $player->steamid, // steam64 id
                'avatar' => $player->avatarLarge,
            ]);
            if (env('APP_ENV') === 'local') {
                $admin = [
                    '76561198068281815', //atlas
                    '76561198077715082' //nobody
                ];
                if(in_array($player->steamid, $admin)){
                    $user->assignRole('root');
                } else{
                    $user->assignRole('user');
                }
            } else {
                if($player->steamid == '{{ user_id }}'){
                    $user->assignRole('root');
                } else{
                    $user->assignRole('user');
                }
            }
        }
        return $user;
    }
}
