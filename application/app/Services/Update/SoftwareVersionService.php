<?php
/**
 * Created by PhpStorm.
 * User: atlas
 * Date: 10/7/2018
 * Time: 11:47 PM
 */

namespace App\Services\Update;

use stdClass;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Contracts\Config\Repository as ConfigRepository;


class SoftwareVersionService{
    // mainly taken from pterodactyl.io, other update methods / services handled by me
    const VERSION_CACHE_KEY = 'saturn:releases';
    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;
    /**
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * SoftwareVersionService constructor.
     *
     * @param \Illuminate\Contracts\Cache\Repository  $cache
     * @param \GuzzleHttp\Client                      $client
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(
        CacheRepository $cache,
        Client $client,
        ConfigRepository $config
    ) {
        $this->cache = $cache;
        $this->client = $client;
        $this->config = $config;
        $this->cacheVersionData();
    }

    /**
     * Get the latest version of the panel from the CDN servers.
     *
     * @return string
     */
    public function getRelease(){
        return object_get($this->cache->get(self::VERSION_CACHE_KEY), 'version', 'error');
    }

    /**
     * Determine if the current version of the panel is the latest.
     *
     * @return bool
     */
    public function isLatestRelease(){
        if ($this->config->get('app.version') === 'development'){
            return true;
        }

        return version_compare($this->config->get('app.version'), $this->getRelease()) >= 0;
    }

    /**
     * Keeps the versioning cache up-to-date with the latest results from the CDN.
     */
    protected function cacheVersionData(){
        $this->cache->remember(self::VERSION_CACHE_KEY, 60, function () {
            try {
                $response = $this->client->request('GET', 'http://saturn.wrld.digital/releases/latest.json');
                if ($response->getStatusCode() === 200) {
                    return json_decode($response->getBody());
                }
                throw new Exception();
            } catch (Exception $exception) {
                return new stdClass();
            }
        });
    }
}