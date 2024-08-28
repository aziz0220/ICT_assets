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
    protected $fillable = ['asset_name', 'purchased_date','end_of_life','warrant','quantity','is_registered','head_approval','vendor_id','status_id','category_id','standard_id','created_by','office_id'];
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
    public function office()
    {
        return $this->belongsTo(Office::class);
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

    public function registerAsset()
    {
        if ($this->head_approval == 1 && $this->is_registered == 0) {
            $this->is_registered = 1;
            $this->save();
        } else {
            session()->flash('error', 'Asset cannot be registered. Conditions not met.');
            return false;
        }
    }

    public function unregisterAsset()
    {
        if ($this->head_approval == 1 && $this->is_registered == 1) {
            $this->is_registered = false;
            $this->save();
        } else {
            session()->flash('error', 'Asset cannot be unregistered. Conditions not met.');
            return false;
        }
    }


    public function approveNewRequest()
    {
        if ($this->is_registered == 0 && $this->head_approval == 0) {
            $this->head_approval = 1;
            $this->save();
        } else {
            session()->flash('error', 'Asset cannot be approved. Conditions not met.');
            return false;
        }
    }

    public function disapproveNewRequest()
    {
        if ($this->is_registered == 0 && $this->head_approval == 1) {
            $this->head_approval = 0;
            $this->save();
        } else {
            session()->flash('error', 'Asset cannot be disapproved. Conditions not met.');
            return false;
        }
    }

}
