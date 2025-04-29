<h2>Specializations in {{ $location->name }}</h2>
<ul>
    @foreach($specializations as $specialization)
        <li>
            <a href="{{ url('/' . $specialization->slug . '-' . $location->slug) }}">
                {{ $specialization->name }}
            </a>
        </li>
    @endforeach
</ul>