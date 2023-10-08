<x-app-layout>
    <div class="container">
        <h1>
            Új játékos rögzítése
        </h1>
        <form method="POST" action="{{ route('players.store', [
            'team' => $team,
        ]) }}">
        @csrf
            <div class="mb-4">
                <label for="name">
                    Játékos neve
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                        <div class="mt-2 error">
                            {{ $message }}
                        </div>
                    @enderror
            </div>
            <div class="mb-4">
                <label for="birthdate">
                    Játékos születésnapja
                </label>
                <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}">
                @error('birthdate')
                        <div class="mt-2 error">
                            {{ $message }}
                        </div>
                    @enderror
            </div>
            <div class="mb-4">
                <label for="number">
                    Játékos mezszáma
                </label>
                <input type="number" name="number" id="number" value="{{ old('number') }}">
                    @error('number')
                        <div class="mt-2 error">
                            {{ $message }}
                        </div>
                    @enderror
            </div>
            <div class="mb-4">
                <input type="submit" value="Játékos rögzítése" />
            </div>
        </form>

    </div>
</x-app-layout>
