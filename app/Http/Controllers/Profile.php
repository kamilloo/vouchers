<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profile extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update()
    {
        return view('profile.index');
    }
}
