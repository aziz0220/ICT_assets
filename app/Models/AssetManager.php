<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   AssetManager extends Staff
{
    public $table = 'asset_managers';
    protected $guard_name = "web";
    use HasFactory;

}
