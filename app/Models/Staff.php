<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Staff extends User
{
    use HasFactory;
    protected $guard_name = "web";

    public $table = 'staff';

    public $fillable = [
        'user_id',
        'office_id',
        'is_blocked'
    ];

    public function asset()
    {
        return $this->belongsToMany(Asset::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
