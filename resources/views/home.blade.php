<h2>Select a Location</h2>
<ul>
    @foreach($locations as $location)
        <li>
            <a href="{{ url('/doctors-' . $location->slug) }}">
                {{ $location->name }}
            </a>
        </li>
    @endforeach
</ul>