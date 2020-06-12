<?php
/**
 * Created by PhpStorm.
 * User: atlas
 * Date: 10/7/2018
 * Time: 3:55 AM
 */

namespace App\Services\Binds;

use Illuminate\Support\Facades\DB;
use RachidLaasri\LaravelInstaller\Controllers\DatabaseController as BindedDataBaseController;

use RachidLaasri\LaravelInstaller\Helpers\DatabaseManager;

class DatabaseController extends BindedDataBaseController{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function database(){

        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return redirect()->route('LaravelInstaller::environmentWizard')
                ->with(['message' => 'Your MYSQL details were wrong and we couldn\'t connect to your server, you need to ensure you are using the correct details.']);
        }

        $response = $this->databaseManager->migrateAndSeed();

        return redirect()->route('LaravelInstaller::final')
            ->with(['message' => $response]);
    }
}