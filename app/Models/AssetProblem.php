<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetProblem extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'asset_problems';

    protected $fillable = [
        'asset_id',
        'description',
        'is_resolved',
        'issued_by'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
