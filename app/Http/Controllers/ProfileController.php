<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Models\Branch;
use App\Models\Skill;
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
        $own_branches = $guard->user()->branches()->get()->map($this->toTagable());
        $own_skills = $guard->user()->skills()->get()->map($this->toTagable());
        return view('profile.index', compact('guard', 'own_skills', 'own_branches'));
    }

    public function edit(Guard $guard)
    {
        $branches = Branch::all()->map($this->toTagable());
        $skills = Skill::all()->map($this->toTagable());
        $own_branches = $guard->user()->branches()->get()->map($this->toTagable());
        $own_skills = $guard->user()->skills()->get()->map($this->toTagable());
        return view('profile.edit', compact('guard','branches', 'skills', 'own_branches', 'own_skills'));
    }

    public function update(ProfileUpdate $request, UserManager $user_manager)
    {
        $user_manager->update($request);


        return redirect(route('profile.index'))->with('success', 'Your profile was updated!');
    }

    /**
     * @return \Closure
     */
    protected function toTagable(): \Closure
    {
        return function ($branch) {
            return [
                'key' => $branch->slug,
                'value' => $branch->name,
            ];
        };
    }

}
