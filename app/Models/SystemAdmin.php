<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class SystemAdmin extends Staff
{
    use HasFactory;
    use HasRoles;

    public $table = 'system_admins';
    protected $guard_name = "web";


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
