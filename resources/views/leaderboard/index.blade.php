<x-app-layout>
    <div class="container">
        <h1>
            Tabella
        </h1>

        <table>
            <thead>
                <th>
                    Csapat
                </th>
                <th>
                    Pontok
                </th>
                <th>
                    Gólülönbség
                </th>
            </thead>
            @forelse ($teams as $team)
                <tr>
                    <td>
                        <x-team-name :team="$team" />
                    </td>
                    <td class="text-center">
                        {{ $team->points }}
                    </td>
                    <td class="text-center">
                        {{ $team->goal_difference }}
                    </td>
                </tr>
            @empty
                Nincs csapat az adatbázisban!
            @endforelse
        </table>
    </div>
</x-app-layout>
