<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Models\UserProfile;
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

    public function update(ProfileUpdate $request, Guard $guard, FilesystemManager $file_manager)
    {
        $profile_attributes = $request->only([
            'first_name',
            'last_name',
            'company_name',
            'address',
            'city',
            'postcode',
            'services',
            'branch',
            'description',
        ]);

        $file = $request->file('avatar');
        if (!empty($file))
        {
            $logo = $this->replaceLogo($file);
            Arr::set($profile_attributes, 'avatar', $logo);
        }

        $profile = $guard->user()->profile()->first();
        if (empty($profile))
        {
            $guard->user()->profile()->save(new UserProfile($profile_attributes));
        }else{
            $profile->update($profile_attributes);
        }
        return redirect(route('profile.index'))->with('success', 'Your profile was updated!');
    }

    /**
     * @param ProfileUpdate $request
     *
     * @return false|string
     */
    protected function replaceLogo(UploadedFile $file)
    {
        return $file->storePublicly('public/logos');
    }
}
