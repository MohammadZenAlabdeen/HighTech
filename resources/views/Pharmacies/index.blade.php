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
    <h1 class="mb-4">Pharmacies</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Created At</th>
                <th>state</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pharmacies as $pharmacy)
                <tr>
                    <td>{{ $pharmacy->name }}</td>
                    <td>{{ $pharmacy->latitude }}</td>
                    <td>{{ $pharmacy->longitude }}</td>
                    <td>{{ $pharmacy->created_at->format('Y-m-d') }}</td>
                    <td>{{$pharmacy->state ? 'open':'closed'}}</td>
                    <td>
                        <form action="{{ route('Pharmacies.delete', $pharmacy) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

</body>
</html>