<?php
declare(strict_types=1);

namespace Domain\Merchants\Managers;

use App\Http\ContentTypes\Tag;
use App\Http\Requests\ProfileUpdate;
use App\Models\User;
use Domain\Merchants\Models\Branch;
use Domain\Merchants\Models\Skill;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use App\Models\UserProfile;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class UserManager
{
    /**
     * @var Guard
     */
    protected $guard;
    /**
     * @var Branch
     */
    protected $branch;
    /**
     * @var Skill
     */
    protected $skill;

    public function __construct(Guard $guard, Branch $branch, Skill $skill)
    {
        $this->guard = $guard;
        $this->branch = $branch;
        $this->skill = $skill;
    }

    public function update(ProfileUpdate $request)
    {
        $profile_attributes = $request->only([
            'first_name',
            'last_name',
            'company_name',
            'address',
            'city',
            'postcode',
            'phone',
            'description',
            'homepage',
        ]);

        $file = $request->file('avatar');
        if (!empty($file))
        {
            $logo = $this->replaceLogo($file);
            Arr::set($profile_attributes, 'avatar', $logo);
        }

        $profile = $this->getAuthUser()->profile()->first();
        if (empty($profile))
        {
            $this->getAuthUser()->profile()->save(new UserProfile($profile_attributes));
        }else{
            $profile->update($profile_attributes);
        }

        $this->syncBranches($request);
        $this->syncSkills($request);
    }

    public function syncBranches(ProfileUpdate $request)
    {
        $branches = Collection::make($request->getBranches())->map(function (Tag $tag){
            return $this->branch->newModelQuery()->firstOrCreate([
                'slug' => $tag->getKey(),
                'name' => $tag->getValue(),
            ]);
        });
        $this->getAuthUser()->branches()->sync($branches->pluck('id'));
    }

    public function syncSkills(ProfileUpdate $request)
    {
        $skills = Collection::make($request->getSkills())->map(function (Tag $tag){
            return $this->skill->newModelQuery()->firstOrCreate([
                'slug' => $tag->getKey(),
                'name' => $tag->getValue(),
            ]);
        });
        $this->getAuthUser()->skills()->sync($skills->pluck('id'));
    }

    /**
     * @param ProfileUpdate $request
     *
     * @return false|string
     */
    protected function replaceLogo(UploadedFile $file)
    {
        return Str::replaceFirst('public', 'storage', $file->storePublicly('public/logos'));
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|User
     */
    protected function getAuthUser():Authenticatable
    {
        return $this->guard->user();
    }
}
