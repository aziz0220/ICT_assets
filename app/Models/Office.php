<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'location', 'head_id'];
    public function staff()
    {
        return $this->hasMany(Staff::class, 'office_id');
    }

    public function asset(){
        return $this->hasMany(Asset::class);

    }

    public function headOffice()
    {
        return $this->belongsTo(Staff::class, 'head_id');
    }

}
