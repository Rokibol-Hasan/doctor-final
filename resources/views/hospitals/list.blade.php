<h2>Hospitals in {{ $location->name }}</h2>
<ul>
@foreach($hospitals as $hospital)
    <li><a href="{{ url('/' . $hospital->slug) }}">{{ $hospital->name }}</a></li>
@endforeach
</ul>