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
    protected $fillable = ['asset_name', 'purchased_date','end_of_life','warrant','quantity','is_registered','vendor_id','status_id','category_id','standard_id','created_by'];
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
        return $this->belongsTo(Staff::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function change(){
        return $this->hasMany(AssetChange::class);
    }

    public function problem(){
        return $this->hasMany(AssetProblem::class);
    }

    public function maintenance(){
        return $this->hasMany(AssetMaintenance::class);
    }

}
