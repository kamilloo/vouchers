<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Models\UserProfile;
use Domain\Merchants\Managers\UserManager;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class ProfileController extends Controller
{
    public function index(Guard $guard)
    {
        return view('profile.index', compact('guard'));
    }

    public function edit(Guard $guard)
    {
        return view('profile.edit', compact('guard'));
    }

    public function update(ProfileUpdate $request, UserManager $user_manager)
    {
        $user_manager->update($request);


        return redirect(route('profile.index'))->with('success', 'Your profile was updated!');
    }


}
