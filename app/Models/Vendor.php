<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'vendors';
    protected $fillable = ['vendor_name','vendor_shortname','created_by'];

    protected $guarded = ['created_at', 'updated_at','deleted_at'];


    public function asset()
    {
        return $this->hasMany(Asset::class);
    }


}
