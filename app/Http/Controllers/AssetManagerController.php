<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssetManagerController extends UserController
{
    public function __construct()
    {
        $this->middleware('role_or_permission:Asset Manager');
    }
}
