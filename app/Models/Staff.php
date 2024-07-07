<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends User
{
    use HasFactory;


    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }
    public function requestAssetChange(){

    }

    public function reportAssetProblem(){

    }
    public function requestAssetMaintainance(){

    }
    public function requestNewAsset(){

    }
}
