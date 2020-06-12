<?php

namespace App\Http\Middleware;

use Closure;

class CheckForInstall{
    /**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled(){
        return file_exists(storage_path('installed'));
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if (!$this->alreadyInstalled()){
            return redirect()->route('LaravelInstaller::welcome');
        }
        return $next($request);
    }
}
