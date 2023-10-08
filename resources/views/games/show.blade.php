<x-app-layout>
    <div class="container">
        <h1>
            {{ $game->home->name }} - {{ $game->away->name }}
        </h1>
        @if(!$game->scheduled)
        <h2>
            {{ $game->home_points }} - {{ $game->away_points }}
        </h2>
        @endif

        @if (Session::get("event-created"))
            <div class="success">
                Esemény sikeresen rögzítve!
            </div>
        @endif

        @if (Session::get("event-deleted"))
            <div class="success">
                Esemény sikeresen törölve!
            </div>
        @endif

        @if (Session::get("game-created"))
            <div class="success">
                Mérkőzés sikeresen létrehozva!
            </div>
        @endif

        @if (Session::get("game-updated"))
            <div class="success">
                Mérkőzés sikeresen frissítve!
            </div>
        @endif

        <div class="pb-4">

            @can ("create", [App\Models\Event::class, $game])
                <a class="button"
                    href="
                {{ route('events.create', [
                    'game' => $game,
                ]) }}
                ">
                    Új esemény rögzítése
                </a>
            @endif

            @can('update', $game)
                <a class="button" href="{{ route('games.edit', ['game' => $game]) }}">
                    Mérkőzés szerkesztése
                </a>
            @endcan

            @can('finish', $game)
                <form method="POST" action="{{ route('games.finish', [ 'game' => $game ])}}" class="inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="finished" value="true">
                    <input type="submit" value="Meccs lezárása" class="inline !bg-yellow-500" />
                </form>
            @endcan
            
            @can('delete', $game)
                <form class="inline" method="POST"
                    action="{{ route('games.destroy', [
                        'game' => $game,
                    ]) }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="!bg-red-700" value="Mérkőzés törlése">
                </form>
            @endcan
        </div>
        <div>
            Kezdés: {{ $game->start }}
        </div>
        <div>
            Befejezve: @if ($game->finished)
                Igen
            @else
                Nem
            @endif
        </div>

        <h2>
            Események
        </h2>
        <table>
            <thead>
                <th>
                    Perc
                </th>
                <th>
                    Csapat
                </th>
                <th>
                    Játékos
                </th>
                <th>
                    Esemény
                </th>
                <th>
                    Műveletek
                </th>
            </thead>
            <tbody>
                @forelse ($game->events->sortByDesc("minute") as $event)
                    <tr>
                        <td class="text-center">
                            {{ $event->minute }}
                        </td>
                        <td>
                            {{ $event->team->name }}
                        </td>
                        <td>
                            {{ $event->player->name }}
                        </td>
                        <td>
                            {{ $event->type }}
                        </td>
                        <td>
                            @can('delete', $event)
                                <form method="POST"
                                    action="{{ route('events.destroy', [
                                        'event' => $event,
                                        'game' => $event->game,
                                    ]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Törlés">
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    Nincs a meccshez tartozó esemény!
                @endforelse
            </tbody>
        </table>
    </div>

</x-app-layout>
