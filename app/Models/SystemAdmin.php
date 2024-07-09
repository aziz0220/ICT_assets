<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemAdmin extends Staff
{
    use HasFactory;
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
    public function assignRole(){

    }
}
