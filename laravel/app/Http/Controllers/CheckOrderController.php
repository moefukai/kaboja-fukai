<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckOrderController extends Controller
{
    public function showTabs()
    {

        return view('checkorder.main');
    }
}
