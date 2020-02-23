<div class="profile-work">
    <p>{{ __('Branches') }}</p>
    <branch-input input-name="branches" :selected-tags="{{ $own_branches }}" :existing-tags="{{ $branches }}"></branch-input>
    <p>{{ __('Skills') }}</p>

    <branch-input input-name="skills" :selected-tags="{{ $own_skills }}" :existing-tags="{{ $skills }}"></branch-input>
</div>
