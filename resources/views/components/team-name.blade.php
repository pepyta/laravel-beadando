@auth
    <div class="mr-2 inline">
        <x-favorite-button :team="$team" />
    </div>
@endauth

<div class="mr-2 inline">
    <x-team-image :team="$team" />
</div>

{{ $team->name }}
