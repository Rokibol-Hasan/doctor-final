<h1>Dr. {{ $doctor->name }}</h1>

<p><strong>Specialization:</strong> {{ $doctor->specialization->name ?? 'N/A' }}</p>
<p><strong>Location:</strong> {{ $doctor->location->name ?? 'N/A' }}</p>

<hr>

<h2>Chambers</h2>

@if($doctor->chambers->count())
    <ul>
        @foreach($doctor->chambers as $chamber)
            <li style="margin-bottom: 15px;">
                <strong>{{ $chamber->name }}</strong><br>
                Address: {{ $chamber->address }}<br>
                Visiting Hours: {{ $chamber->visiting_hours }}
            </li>
        @endforeach
    </ul>
@else
    <p>No chambers listed for this doctor.</p>
@endif
