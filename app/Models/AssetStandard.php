<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetStandard extends Model
{
    use HasFactory;

    protected $fillable = ['item_name', 'description'];

    public function standard()
    {
        return $this->belongsTo(AssetCategory::class);
    }

    public function asset()
    {
        return $this->hasMany(Asset::class);
    }
}
