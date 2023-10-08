@php
    $type_options = [
    [
        'name' => 'Piros lap',
        'value' => 'RED_CARD',
    ],
    [
        'name' => 'Sárga lap',
        'value' => 'YELLOW_CARD',
    ],
    [
        'name' => 'Zöld lap',
        'value' => 'GREEN_CARD',
    ],
    [
        'name' => 'Gól',
        'value' => 'GOAL',
    ],
    [
        'name' => 'Öngól',
        'value' => 'SELF_GOAL',
    ],
];
@endphp

<x-app-layout>
    <div class="container">
        <h1>
            Új esemény rögzítése
        </h1>
        <h2>
            {{ $game->home->name }} - {{ $game->away->name }}
        </h2>
        <form method="POST" action="{{ route('events.store', [
            'game' => $game->id,
        ]) }}">
            <div class="mb-2">
                <label for="minute">Perc: </label>
                <input id="minute" type="number" name="minute" value="{{ old('minute') }}" />
            </div>

            @error('minute')
                <div class="mb-2 error">
                    {{ $message }}
                </div>
            @enderror

            <div class="mb-2">
                <label for="type">Típus: </label>

                <select name="type">
                    @foreach ($type_options as $option)
                        <option value="{{ $option["value"] }}"
                            @if (old('type') == $option["value"]) {{ 'selected' }} @endif>
                            {{ $option["name"] }}
                        </option>
                    @endforeach
                </select>
            </div>

            @error('type')
                <div class="mb-2 error">
                    {{ $message }}
                </div>
            @enderror

            <div class="mb-2">
                <label for="player">Játékos: </label>
                <select name="player_id">
                    <option value="123456789">
                        Nem létező játékos
                    </option>
                    @foreach ($players as $player)
                        <option value="{{ $player->id }}"
                            @if ($player->id == old('player_id')) {{ 'selected' }} @endif>
                            {{ $player->number }} {{ $player->name }} ({{ $player->team->name }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            @error('player_id')
                <div class="mb-2 error">
                    {{ $message }}
                </div>
            @enderror

            @csrf

            <div>
                <input type="submit" value="Mentés" />
            </div>
        </form>
    </div>

</x-app-layout>
