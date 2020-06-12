<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Feature;
use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\Server;
use App\Models\Team;
use App\Services\Update\SoftwareVersionService;
use App\User;
use Illuminate\Support\Facades\Cache;


class IndexController extends Controller{
    /**
     * @var SoftwareVersionService
     */
    private $version;

    /**
     * BaseController constructor.
     *
     * @param SoftwareVersionService $version
     */
    public function __construct(SoftwareVersionService $version)
    {
        $this->version = $version;
    }


    public function index(){
        // dont cache this, pagination will break hehe x
        $users = User::paginate(15);

        $teams = Cache::rememberForever('teams', function() {
            return Team::all();
        });


        $servers = Cache::rememberForever('servers_count', function() {
            return Server::all();
        });

        $links = Cache::rememberForever('links', function() {
            return Link::all();
        });

        $features = Cache::rememberForever('features', function() {
            return Feature::all();
        });

        return view('index', ['version' => $this->version], compact('users', 'features', 'teams', 'servers', 'links'));
    }
}
