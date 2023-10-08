<table>
    <thead>
        <th>
            Csapat
        </th>
        <th>
            Rövidítés
        </th>
        <th></th>
    </thead>
    @forelse ($teams as $team)
        <tr>
            <td>
                <x-team-name :team="$team" />
            </td>
            <td class="text-center">
                {{ $team->shortname }}
            </td>
            <td class="text-center">
                <a href="{{ route('teams.show', ['team' => $team]) }}">
                    Megnyitás
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">
                Nincs megjeleníthető csapat!
            </td>
        </tr>
    @endforelse
</table>
