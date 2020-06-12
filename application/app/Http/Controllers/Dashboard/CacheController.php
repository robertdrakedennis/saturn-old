<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    /*
    * @return \Illuminate\Http\Response
     */
    public function clear(){
        Artisan::call('cache:clear');
        alert()->success('Cache Cleared!', 'If you\'re still having issues, contact support.')->showConfirmButton('Ok, got it');
        return back();
    }
}
