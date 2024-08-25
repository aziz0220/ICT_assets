<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class ExecutiveManagement extends Staff
{

    public $table = 'executive_management';
    protected $guard_name = "web";
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


}
