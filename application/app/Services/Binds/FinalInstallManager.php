<?php
/**
 * Created by PhpStorm.
 * User: atlas
 * Date: 10/6/2018
 * Time: 11:52 AM
 */

namespace App\Services\Binds;

use RachidLaasri\LaravelInstaller\Helpers\FinalInstallManager as BindedFinalInstallManager;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

class FinalInstallManager extends BindedFinalInstallManager
{
    /**
     * Run final commands.
     *
     * @return collection
     */
    public function runFinal()
    {
        $outputLog = new BufferedOutput;

        $this->generateKey($outputLog);

        return $outputLog->fetch();
    }

    /**
     * Generate New Application Key.
     *
     * @param collection $outputLog
     * @return collection
     */
    private static function generateKey($outputLog)
    {
        try{
            if (config('installer.final.key')){
                Artisan::call('key:generate', ["--force"=> true], $outputLog);
            }
        }
        catch(Exception $e){
            return static::response($e->getMessage(), $outputLog);
        }

        return $outputLog;
    }

    /**
     * Publish vendor assets.
     *
     * @param collection $outputLog
     * @return collection
     */
    private static function publishVendorAssets($outputLog)
    {
        try{
            if (config('installer.final.publish')){
                Artisan::call('vendor:publish', ['--all' => true], $outputLog);
            }
        }
        catch(Exception $e){
            return static::response($e->getMessage(), $outputLog);
        }

        return $outputLog;
    }

    /**
     * Return a formatted error messages.
     *
     * @param $message
     * @param collection $outputLog
     * @return array
     */
    private static function response($message, $outputLog)
    {
        return [
            'status' => 'error',
            'message' => $message,
            'dbOutputLog' => $outputLog->fetch()
        ];
    }
}