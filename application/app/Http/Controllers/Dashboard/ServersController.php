<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Server;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ServersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $servers = Server::all();
        return view('servers.index', compact('servers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'ip' => 'bail|required|max:255',
            'port' => 'required|max:255',
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

        Server::create([
            'name' => $request->name,
            'description' => $request->description,
            'ip' => $request->ip,
            'port' => $request->port,
            'img_url' => $request->img_url,
            'fa_icon' => $request->fa_icon,
            'fa_color' => $request->fa_color,
            'display' => $request->display
        ]);

        Cache::forget('servers');
        Cache::forget('servers_count');

        toast('Server Created Successfully!','success','top-right');
        return back()->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Server $server
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server){
        $info =  (new Server)->Info($server);
        return view('servers.edit', compact('server', 'info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Models\Server $server
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Server $server){
        $validator = Validator::make($request->all(), [
            'ip' => 'bail|required|min:5|max:255',
            'port' => 'required|min:5|max:255',
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

        $server->fill($request->input())->save();

        Cache::forget('servers');
        Cache::forget('servers_count');

        toast('Server Edited Successfully!','success','top-right');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Server $server
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Server $server){
        $server->delete();
        Cache::forget('servers_count');
        Cache::forget('servers');
        toast('Server Deleted Successfully!','success','top-right');
        return redirect(route('dashboard.servers'));
    }
}
