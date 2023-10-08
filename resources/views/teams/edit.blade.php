<x-app-layout>
    <div class="container">
        <h1>
            Csapat szerkesztése
        </h1>
        <form method="POST" action="{{ route('teams.update', [ "team" => $team ]) }}" enctype="multipart/form-data">
            @method("PATCH")
            @csrf
            <div class="mb-4">
                <label for="name">
                    Csapat neve
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $team->name) }}">
                @error('name')
                    <div class="mt-2 error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="shortname">
                    Csapat rövidneve
                </label>
                <input type="text" name="shortname" id="shortname" value="{{ old('shortname', $team->shortname) }}">
                @error('shortname')
                    <div class="mt-2 error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="image">
                    Csapat logója
                </label>
                <input type="file" name="image" id="image" value="{{ old('image') }}">
                @error('image')
                    <div class="mt-2 error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <input type="submit" value="Változtatások mentése" />
            </div>
        </form>

    </div>
</x-app-layout>
