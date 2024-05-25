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
    <h1 class="mb-4">Pharmacy Registers</h1>

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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pharmacyRegisters as $pharmacyRegister)
                <tr>
                    <td>{{ $pharmacyRegister->name }}</td>
                    <td>{{ ($pharmacyRegister->latitude) }}</td>
                    <td>{{ ($pharmacyRegister->longitude) }}</td>
                    <td>{{ $pharmacyRegister->created_at->format('Y-m-d') }}</td>
                    <td>
                        <form action="{{ route('PharmaciesRegisters.accept', $pharmacyRegister) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Accept</button>
                        </form>
                        <form action="{{ route('PharmaciesRegisters.decline', $pharmacyRegister) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Decline</button>
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