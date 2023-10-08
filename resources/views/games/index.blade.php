<x-app-layout>
    <div class="container">
        <h1>
            Mérkőzések
        </h1>

        @can("create", App\Models\Game::class)
            <div>
                <a class="button" href="{{ route("games.create" )}}">
                    Mérkőzés létrehozása
                </a>
            </div>
        @endcan

        @if (Session::get("game-deleted"))
            <div class="success">
                Mérkőzés sikeresen törölve!
            </div>
        @endif

        <h2>
            Folyamatban lévő mérkőzések
        </h2>

        <x-game-table :games="$ongoing" :result="true" />


        <h2>
            Ütemezett mérkőzések
        </h2>
        <x-game-table :games="$scheduled" />

        <h2>
            Befejezett mérkőzések
        </h2>
        <x-game-table :games="$finished" :result="true" />
        {{ $finished->links() }}
    </div>
</x-app-layout>
