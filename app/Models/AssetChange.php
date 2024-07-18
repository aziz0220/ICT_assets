<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetChange extends Asset
{
    use HasFactory;

    public $table = 'asset_changes';
    protected $fillable = ['asset_id','asset_name', 'purchased_date','end_of_life','warrant','quantity','vendor_id','status_id','category_id','standard_id','created_by'];


    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }


}
