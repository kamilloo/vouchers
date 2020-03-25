<div class="profile-work">
    <p>{{ __('Branches') }}</p>
    <small class="text-muted">{{ __('Add branch and press enter') }}</small>
    <branch-input placeholder="{{ __('Add branch') }}" input-name="branches" :selected-tags="{{ $own_branches }}" :existing-tags="{{ $branches }}"></branch-input>
    <p>{{ __('Skills') }}</p>
    <small class="text-muted">{{ __('Add skill and press enter') }}</small>
    <branch-input placeholder="{{ __('Add skill') }}" input-name="skills" :selected-tags="{{ $own_skills }}" :existing-tags="{{ $skills }}"></branch-input>
</div>
