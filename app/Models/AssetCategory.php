<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssetCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name','created_by'];
    protected $guarded = ['created_at', 'updated_at','deleted_at'];

    public function asset(): HasMany
    {
        return $this->hasMany(Asset::class);
    }
    public function standard(): HasMany
    {
        return $this->hasMany(AssetStandard::class);
    }
}
