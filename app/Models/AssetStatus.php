<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['status_name','created_by'];


    public function asset()
    {
        return $this->hasMany(Asset::class, 'status_id');
    }
}
