<x-app-layout>
    <div class="container">
        
        <form method="POST" action="{{ route("games.store") }}">
            <div class="mb-4">
                <div>
                    <label for="home_team_id">
                        Hazai csapat
                    </label>
                </div>
                <div>
                    <select name="home_team_id" id="home_team_id">
                        <option value="-1"
                            @if(old("home_team_id") == "not_existing") {{ "selected" }} @endif>
                            Nem létező csapat
                        </option>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}"
                                @if (old("home_team_id") == $team->id) {{ "selected" }} @endif>
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
                        <option value="-1"
                            @if(old("away_team_id") == "not_existing") {{ "selected" }} @endif>
                            Nem létező csapat
                        </option>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}"
                                @if (old("away_team_id") == $team->id) {{ "selected" }} @endif>
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
                    <input value="{{ old("start") }}" type="datetime-local" name="start" id="start">
                </div>   
                @error('start')
                    <div class="mb-2 error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            @csrf

            <input type="submit" value="Meccs létrehozása">
        </form>

    </div>
</x-app-layout>
