<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetMaintenance extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'asset_maintenances';

    protected $fillable = [
        'asset_id',
        'description',
        'status',
        'issued_by'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
