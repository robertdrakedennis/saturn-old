<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class InsertDefaultPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Role::create(['name' => 'root']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        // No need to create permissions, we can just use this role and blade sugar / middleware to block anything we don't want non-admins to go to
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
