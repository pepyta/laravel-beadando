<x-app-layout>
    <div class="container">
        <h1>
            Csapatok
        </h1>
        @can("create", App\Models\Team::class)
            <div class="mt-2 mb-2">
                <a href="{{ route("teams.create") }}" class="button">
                    Csapat létrehozása
                </a>
            </div>
        @endcan

        <x-team-table :teams="$teams" />
    </div>
</x-app-layout>
