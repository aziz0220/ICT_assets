<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'assets';
    protected $fillable = ['asset_name', 'purchased_date','end_of_life','warrant','quantity','vendor_id','status_id','category_id','standard_id','created_by'];
    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
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

    public function staff()
    {
        return $this->belongsToMany(Staff::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

}
