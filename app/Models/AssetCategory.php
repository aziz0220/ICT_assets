<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['category_name','created_by','logo'];
    protected $guarded = ['created_at', 'updated_at','deleted_at'];

    public function asset(): HasMany
    {
        return $this->hasMany(Asset::class,'category_id');
    }
    public function standard(): HasMany
    {
        return $this->hasMany(AssetStandard::class,'category_id');
    }
}
