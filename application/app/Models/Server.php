<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use xPaw\SourceQuery\SourceQuery;

class Server extends Model
{

    protected $table = 'servers';

    protected $fillable = [
        'name',
        'description',
        'ip',
        'port',
        'img_url',
        'fa_icon',
        'fa_color',
        'display'
    ];

    public $timestamps = false;

    public function info($server){
        $query = new SourceQuery();
        try{
            $query->Connect($server->ip, $server->port, 3, SourceQuery::SOURCE);
            $info = $query->GetInfo();
        } catch (\Exception $e){
            $info = null;
        }
        finally {
            $query->disconnect();
        }
        return $info;
    }
}
