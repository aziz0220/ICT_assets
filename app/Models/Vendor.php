<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    public $table = 'vendors';
    protected $fillable = ['vendor_name','vendor_shortname'];

    protected $guarded = ['created_by','created_at', 'updated_at','deleted_at'];


    public function asset()
    {
        return $this->hasMany(Asset::class);
    }


}
