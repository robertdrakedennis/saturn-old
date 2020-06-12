<?php

namespace App\Http\Controllers\Dashboard;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Services\Update\SoftwareVersionService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class UpdatesController extends Controller{
    /**
     * @var SoftwareVersionService
     */
    private $version;


    /**
     * BaseController constructor.
     *
     * @param SoftwareVersionService $version
     */
    public function __construct(SoftwareVersionService $version){
        $this->version = $version;

    }


    public function index(){
        return view('update.index', ['version' => $this->version]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forcecheckupdate(){
        Cache::forget('saturn:releases');

        return redirect()->route('dashboard.update');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(){
        $url = 'http://saturn.wrld.digital/releases/' . $this->version->getRelease() . '.zip';
        $guzzle = new Client();
        $response = $guzzle->get($url);
        Storage::disk('public_installs')->put($this->version->getRelease() . '.zip', $response->getBody());


        $zip = new ZipArchive;
        $zip->open( public_path() . $this->version->getRelease() . '.zip');
        $zip->extractTo(public_path());
        $zip->close();

        Artisan::call('migrate', ["--force"=> true]);

        Storage::disk('public_installs')->delete($this->version->getRelease() . '.zip');

        Artisan::call('cache:clear');

        alert()->success('Successfully Updated!', 'Thanks for using Saturn, enjoy the new updates!')->showConfirmButton('Ok, got it');
        return redirect()->route('dashboard.update');
    }
}
