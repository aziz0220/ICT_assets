<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetStandard extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['item_name', 'description','category_id','created_by'];

    public function category()
    {
        return $this->belongsTo(AssetCategory::class);
    }

    public function asset()
    {
        return $this->hasMany(Asset::class, 'standard_id');
    }
}
