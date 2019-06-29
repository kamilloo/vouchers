<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Starter extends Controller
{
    public function getStarted()
    {
        return view('starter.get');
    }

}
