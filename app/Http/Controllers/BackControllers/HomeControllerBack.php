<?php

namespace App\Http\Controllers\BackControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeControllerBack extends Controller
{
    public function index()  {
        return view('/Back/homeback');
    }
}
