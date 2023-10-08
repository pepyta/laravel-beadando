<x-app-layout>
    <div class="container">
        <h1>
            {{ $game->home->name }} - {{ $game->away->name }}
        </h1>
        <h2>
            {{ $game->home_points }} - {{ $game->away_points }}
        </h2>

        <form method="POST" novalidate action="{{ route('games.update', [
            'game' => $game,
        ]) }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <div>
                    <label for="home_team_id">
                        Hazai csapat
                    </label>
                </div>
                <div>
                    <select name="home_team_id" id="home_team_id">
                        <option value="-1" @if (old('home_team_id', $game->home_team_id) == 'not_existing') {{ 'selected' }} @endif>
                            Nem létező csapat
                        </option>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}"
                                @if (old('home_team_id', $game->home_team_id) == $team->id) {{ 'selected' }} @endif>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('home_team_id')
                    <div class="mb-2 error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <div>
                    <label for="away_team_id">
                        Ellenfél csapat
                    </label>
                </div>
                <div>
                    <select name="away_team_id" id="away_team_id">
                        <option value="-1" @if (old('away_team_id', $game->away_team_id) == 'not_existing') {{ 'selected' }} @endif>
                            Nem létező csapat
                        </option>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}"
                                @if (old('away_team_id', $game->away_team_id) == $team->id) {{ 'selected' }} @endif>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('away_team_id')
                    <div class="mb-2 error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <div>
                    <label for="start">
                        Kezdés időpontja
                    </label>
                </div>
                <div>
                    <input value="{{ old('start', $game->start) }}" type="datetime-local" name="start"
                        id="start">
                </div>
                @error('start')
                    <div class="mb-2 error">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-4">
                <label for="finished">
                    Befejezve?
                </label>
                <input id="finsihed" type="checkbox" @if (old('finished', $game->finished)) {{ "checked" }} @endif name="finished" />

                @error('finished')
                    <div class="mb-2 error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <input type="submit" value="Meccs frissítése" class="button" />
            </div>
        </form>
    </div>
</x-app-layout>
