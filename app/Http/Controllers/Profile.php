<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class Profile extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(ProfileUpdate $request, Guard $guard)
    {

        $profile = $guard->user()->profile()->firstOrCreate([]);
//        $profile->fill($request->only(array_keys($request->rules())));
        $profile->address = '123';
        $profile->save();

        return redirect(route('profile.index'));
    }
}
