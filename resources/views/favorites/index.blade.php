<x-app-layout>
    <div class="container">
        <h1>
            Kedvenceim
        </h1>

        @if (Session::get('favorite-created'))
            <div class="success">
                Csapat sikeresen hozzáadva a kedvenekhez!
            </div>
        @endif

        @if (Session::get('favorite-deleted'))
            <div class="success">
                Csapat sikeresen eltávolítva a kedvencek közül!
            </div>
        @endif

        <x-game-table :games="$games" />
    </div>
</x-app-layout>
