@if ($team->favorite)
    <form method="POST" action="{{ route('favorites.destroy', ['favorite' => $team->favorite]) }}" class="inline">
        @method('DELETE')
        @csrf
        <input type="submit" value="★" class="!bg-yellow-400 inline !p-1 !pr-2 !pl-2" />
    </form>
@else
    <form method="POST" action="{{ route('favorites.store') }}" class="inline">
        @csrf
        <input type="hidden" name="team_id" value="{{ $team->id }}" />
        <input type="submit" value="★" class="inline !p-1 !pr-2 !pl-2" />
        @error('team_id')
            <div class="mb-2 error">
                {{ $message }}
            </div>
        @enderror
    </form>
@endif
