<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Register a New Pharmacy</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('PharmaciesRegisters.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Pharmacy Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="number" class="form-control" id="latitude" name="latitude" readonly required>
                        </div>
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="number" class="form-control" id="longitude" name="longitude" readonly required>
                        </div>
                        <button type="button" class="btn btn-primary" id="getLocationBtn">Get Current Location</button>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
  const getLocationBtn = document.getElementById('getLocationBtn');
  const latitudeInput = document.getElementById('latitude');
  const longitudeInput = document.getElementById('longitude');

  getLocationBtn.addEventListener('click', function () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
        console.log(position.coords);
        latitudeInput.value = parseFloat(position.coords.latitude).toFixed(6);
        longitudeInput.value = parseFloat(position.coords.longitude).toFixed(6);
      });
    } else {
      alert('Geolocation is not supported by this browser.');
    }
  });
});
</script>

</body>
</html>