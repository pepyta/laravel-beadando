@if (isset($team->image))
    <img class="inline" src="{{ Storage::url("images/".$team->image) }}" width="24" height="24" />
@else
    <img class="inline" src="https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" width="24"
        height="24" />
@endif
