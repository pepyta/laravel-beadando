<x-app-layout>
    <div class="container">
        <h1>
            {{ $team->name }}
        </h1>

        @can('create', App\Models\Player::class)
            <a href="{{ route('players.create', ['team' => $team]) }}" class="button">
                Új játékos rögzítése
            </a>
        @endcan

        @can('update', $team)
            <a href="{{ route('teams.edit', ['team' => $team]) }}" class="button">
                Csapat szerkesztése
            </a>
        @endcan

        @if (Session::get('team-created'))
            <div class="success">
                Csapat sikeresen létrehozva!
            </div>
        @endif

        @if (Session::get('team-updated'))
            <div class="success">
                Csapat sikeresen szerkesztve!
            </div>
        @endif

        @if (Session::get('player-created'))
            <div class="success">
                Játékos sikeresen létrehozva!
            </div>
        @endif

        @if (Session::get('player-deleted'))
            <div class="success">
                Játékos sikeresen törölve!
            </div>
        @endif

        <h2>
            Játékosok
        </h2>
        <table>
            <thead>
                <th>
                    Mezszám
                </th>
                <th>
                    Név
                </th>
                <th>
                    Születési dátum
                </th>
                <th>
                    Sárga lap
                </th>
                <th>
                    Piros lap
                </th>
                <th>
                    Gólok
                </th>
                <th>
                    Öngólok
                </th>
                <th></th>
            </thead>
            <tbody>
                @forelse ($team->players as $player)
                    <tr>
                        <td class="text-center">
                            {{ $player->number }}
                        </td>
                        <td>
                            {{ $player->name }}
                        </td>
                        <td>
                            {{ $player->birthdate }}
                        </td>
                        <td class="text-center">
                            {{ $player->yellow_cards }}
                        </td>
                        <td class="text-center">
                            {{ $player->red_cards }}
                        </td>
                        <td class="text-center">
                            {{ $player->goals }}
                        </td>
                        <td class="text-center">
                            {{ $player->self_goals }}
                        </td>
                        <td class="text-center">
                            @can('delete', $player)
                                <form method="POST"
                                    action="{{ route('players.destroy', [
                                        'team' => $team,
                                        'player' => $player,
                                    ]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" value="Játékos törlése" class="!bg-red-700" />
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    Nincs játékos a csapatban
                @endforelse
            </tbody>
        </table>
        <h2>
            Meccsek
        </h2>
        <x-game-table :games="$team->games" :result="true" />
    </div>
</x-app-layout>
