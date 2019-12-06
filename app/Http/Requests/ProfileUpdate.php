<?php

namespace App\Http\Requests;

use App\Http\ContentTypes\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class ProfileUpdate
 *
 * @method getBranchesParam
 * @method getSkillsParam
 */
class ProfileUpdate extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['nullable', 'string', 'max:256'],
            'last_name' => ['nullable', 'string', 'max:256'],
            'company_name' => ['nullable', 'string', 'max:256'],
            'address' => ['nullable', 'string', 'max:256'],
            'city' => ['nullable', 'string', 'max:256'],
            'postcode' => ['nullable', 'string', 'max:256'],
            'phone' => ['nullable', 'string', 'max:256'],
            'avatar' => ['nullable', 'file'],
            'description' => ['nullable', 'string', 'max:256'],
            'homepage' => ['nullable', 'string', 'max:256'],
            'branches' => ['nullable', 'array',],
            'skills' => ['nullable', 'array',],
            'skills.*.key' => ['nullable', 'string', 'max:256'],
            'skills.*.value' => ['nullable', 'string', 'max:256'],
            'branches.*.key' => ['nullable', 'string', 'max:256'],
            'branches.*.value' => ['nullable', 'string', 'max:256'],
        ];
    }

    /**
     * @return Tag[]
     */
    public function getBranches(): array
    {
        return $this->contentToTags($this->getBranchesParam(), 'key', 'value');
    }

    /**
     * @return Tag[]
     */
    public function getSkills(): array
    {
        return $this->contentToTags($this->getSkillsParam(), 'key', 'value');
    }

    /**
     * @return Tag[]
     */
    protected function contentToTags(?array $raw_tags, string $key, string $value): array
    {
        return Collection::make($raw_tags)
            ->filter($this->byIncomplete($key, $value))
            ->map($this->toTags($key, $value))
            ->all();
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return \Closure
     */
    protected function byIncomplete(string $key, string $value): \Closure
    {
        return function ($branch) use ($key, $value) {
            return is_array($branch) && isset($branch[$value]);
        };
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return \Closure
     */
    protected function toTags(string $key, string $value): \Closure
    {
        return function (array $branch) use ($key, $value) {
            return new Tag($branch[$key] ?? Str::slug($branch[$value]), $branch[$value]);
        };
    }

}
