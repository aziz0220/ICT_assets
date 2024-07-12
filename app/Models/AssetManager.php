<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class   AssetManager extends Staff
{
    public $table = 'asset_managers';
    protected $guard_name = "web";
    use HasFactory;
    use HasRoles;
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }



}
