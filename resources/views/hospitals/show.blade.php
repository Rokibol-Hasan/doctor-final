<h2>Doctors in {{ $hospital->name }}</h2>
@foreach($hospital->doctors as $doctor)
    <div class="card">
        <h3><a href="{{ url('/' . $doctor->slug) }}">{{ $doctor->name }}</a></h3>
        <p>{{ $doctor->specialization->name }}</p>
    </div>
@endforeach