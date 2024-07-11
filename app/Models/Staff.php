<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends User
{
    use HasFactory;
    protected $guard_name = "web";

    public $table = 'staff';

    public function asset()
    {
        return $this->belongsToMany(Asset::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

}
