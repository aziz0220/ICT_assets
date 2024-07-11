<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'location'];
    public function staff()
    {
        return $this->hasMany(Staff::class, 'office_id');
    }
}
