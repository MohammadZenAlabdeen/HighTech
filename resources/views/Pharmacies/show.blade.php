<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pharmacy Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @extends('layout')

    @section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Pharmacy Details</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header bg-primary text-white">Pharmacy Information</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Pharmacy Name:</label>
                    <p>{{ $pharmacy->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Latitude:</label>
                    <p>{{ $pharmacy->latitude }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Longitude:</label>
                    <p>{{ $pharmacy->longitude }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">State:</label>
                    <p>{{ $pharmacy->state ? 'Open' : 'Closed' }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">User Name:</label>
                    <p>{{ $pharmacy->user->name }}</p>
                </div>
                <form action="{{ route('Pharmacy.state', $pharmacy->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-warning">{{ $pharmacy->state ? 'Close' : 'Open' }} Pharmacy</button>
                </form>
                <a href="{{ route('Pharmacy.edit', $pharmacy->id) }}" class="btn btn-secondary ms-2" style="display: inline-block;">Edit Pharmacy</a>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>
