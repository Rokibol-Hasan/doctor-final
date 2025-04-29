<h2>Doctors in {{ $location->name }} for {{ $specialization->name }}</h2>
@foreach($doctors as $doctor)
<div class="card">
    <h3><a href="{{ url('/' . $doctor->slug) }}">{{ $doctor->name }}</a></h3>
    <p>Specialization: {{ $doctor->specialization->name }}</p>
    <button onclick="toggleChambers({{ $doctor->id }})">View Chambers</button>
    <div id="chambers-{{ $doctor->id }}" style="display:none;">
        <ul>
            @foreach($doctor->chambers as $chamber)
                <li>{{ $chamber->address }} | {{ $chamber->visiting_hours }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endforeach

<script>
function toggleChambers(id) {
    const el = document.getElementById('chambers-' + id);
    el.style.display = el.style.display === 'none' ? 'block' : 'none';
}
</script>
