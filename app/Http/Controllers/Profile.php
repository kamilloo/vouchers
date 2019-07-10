<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Models\UserProfile;
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
        $profile_attributes = $request->only(array_keys($request->rules()));
        $profile = $guard->user()->profile()->first();
        if (empty($profile))
        {
            $guard->user()->profile()->save(new UserProfile($profile_attributes));
        }else{
            $profile->update($profile_attributes);
        }
        return redirect(route('profile.index'));
    }
}
