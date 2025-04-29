<h2>Select Specialization in {{ $location->name }}</h2>
<ul>
@foreach($specializations as $specialization)
    <li><a href="{{ url('/doctors/' . $location->slug . '/' . $specialization->slug) }}">{{ $specialization->name }}</a></li>
@endforeach
</ul>