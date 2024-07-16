<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetMaintenance extends Model
{
    use HasFactory;

    public $table = 'asset_maintenances';

    protected $fillable = ['asset_id', 'description'];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
