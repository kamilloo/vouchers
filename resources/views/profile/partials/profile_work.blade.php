<div class="profile-work">
    <p>{{ __('Branches') }}</p>
    @foreach($own_branches as $branch)
        <span class="badge badge-info">{{ $branch['value'] }}</span><br>
    @endforeach
    <p>{{ __('Skills') }}</p>

    @foreach($own_skills as $skill)
        <span class="badge badge-info">{{ $skill['value'] }}</span><br>
    @endforeach
</div>
