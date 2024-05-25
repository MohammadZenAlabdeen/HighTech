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
    @if(auth()->user()->is_admin == true)
        <div class="container">
            <div class="row my-4">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text">{{ $usersCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Pharmacies</h5>
                            <p class="card-text">{{ $pharmaciesCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Pharmacy Applications</h5>
                            <p class="card-text">{{ $pharmacyApplicationsCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(auth()->user()->pharmacy && auth()->user()->is_admin==false)
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">Pharmacy Details</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Pharmacy Name:</label>
                                <p>{{ $pharmacy->name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Creation Date:</label>
                                <p>{{ $pharmacy->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Updated Date:</label>
                                <p>{{ $pharmacy->updated_at->format('Y-m-d') }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Number of Medicines:</label>
                                <p>{{ $medicineCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(auth()->user()->pharmacyRegister && auth()->user()->is_admin ==false)
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Pharmacy Registration Details</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Pharmacy Name:</label>
                            <p>{{ $pharmacyRegister->name }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Creation Date:</label>
                            <p>{{ $pharmacyRegister->created_at->format('Y-m-d') }}</p>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('PharmaciesRegisters.edit', $pharmacyRegister->id) }}" class="btn btn-primary">Edit Pharmacy Details</a>
                        </div>
                        <div class="mb-3">
                            <form method="POST" action="{{ route('PharmaciesRegisters.destroy', $pharmacyRegister->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete Pharmacy Registration</button>
                            </form>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            This registration is still under review.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-info d-flex align-items-center justify-content-center" role="alert" style="height: 200px;">
                        <div class="text-center">
                            <p class="mb-0">New here? <a href="{{ route('PharmaciesRegisters.create') }}" class="alert-link">Apply your pharmacy to be added</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @endsection
    
</body>
</html>