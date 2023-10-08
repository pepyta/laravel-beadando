<table>
    <thead>
        <th>
            Hazai csapat
        </th>
        <th>
            Vendég csapat
        </th>
        <th>
            Állás
        </th>
        <th>
            Meccs kezdete
        </th>
        <th></th>
    </thead>
    <tbody>
        @forelse ($games as $game)
            <tr>
                <td>
                    <x-team-name :team="$game->home" />
                </td>
                <td>
                    <x-team-name :team="$game->away" />
                </td>
                <td class="text-center">
                    {{ $game->home_points }} - {{ $game->away_points }}
                </td>
                <td class="text-center">
                    {{ $game->start }}
                </td>
                <td class="text-center">
                    <a href="{{ route('games.show', ['game' => $game]) }}">
                        Megnyitás
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">
                    Nincs mérkőzés rögzítve!
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
