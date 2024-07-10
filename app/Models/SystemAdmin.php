<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemAdmin extends Staff
{
    use HasFactory;

    public $table = 'system_admins';
    protected $guard_name = "web";
    public function blockStaff ()
    {

    }

    public function unblockStaff (){

    }

    public function manageRoles(){

    }

    public function managePermissions()
    {

    }
//    public function assignRole(){
//
//    }
}
