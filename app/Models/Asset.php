<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['asset_name', 'purchased_date','end_of_life','warrant','quantity'];
    protected $guarded = ['created_by','created_at', 'updated_at','deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);

    }
    public function category()
    {
        return $this->belongsTo(AssetCategory::class);
    }
    public function standard()
    {
        return $this->belongsTo(AssetStandard::class);
    }
    public function status()
    {
        return $this->belongsTo(AssetStatus::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }


}
