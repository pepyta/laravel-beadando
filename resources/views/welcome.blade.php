<x-app-layout>
    <div class="container">
        <h1>
            Főoldal
        </h1>
        <div class="border p-4 rounded mb-4">
            Üdvözöllek a Laravel beadandó oldalán! Ezen a weboldalon football csapatokat lehet kezelni, illetve a hozzájuk tartozó meccseket lehet kezelni.
        </div>
        <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
            <a href="/teams">
                <div class="border p-4 rounded">
                    Csapatok
                </div>
            </a>
            <a href="/leaderboard">
                <div class="border p-4 rounded">
                    Tabella
                </div>
            </a>
            <a href="/games">
                <div class="border p-4 rounded">
                    Mérkőzések
                </div>
            </a>
            <a href="/favorites">
                <div class="border p-4 rounded">
                    Kedvenceim
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
