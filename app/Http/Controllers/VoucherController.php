<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Models\UserProfile;
use App\Models\Voucher;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class VoucherController extends Controller
{
    public function index(Guard $guard)
    {
        $vouchers = Voucher::Mine()->get();
        return view('vouchers.index', compact('vouchers'));
    }

    public function edit(Voucher $voucher)
    {
        return view('vouchers.edit', compact('voucher'));
    }

    public function update(ProfileUpdate $request, Guard $guard, FilesystemManager $file_manager)
    {
        $profile_attributes = $request->only([
            'address',
            'company_name',
            'first_name',
            'last_name',
            'services',
            'description',
            'branch'
        ]);

        $file = $request->file('logo');
        if (!empty($file))
        {
            $logo = $this->replaceLogo($file);
            Arr::set($profile_attributes, 'logo', $logo);
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
