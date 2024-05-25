<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- resources/views/medicines/create.blade.php -->

@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-md-12">
            <h1 class="display-4">Update Medicine of {{ auth()->user()->pharmacy->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('pharmacy.medicines.update',[$medicine->pharmacy,$medicine])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Medicine Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$medicine->name }}" required>
                </div>
                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" class="form-control" id="company" name="company" value="{{$medicine->company }}" required>
                </div>
                <div class="form-group">
                    <label for="count">Count</label>
                    <input type="number" class="form-control" id="count" name="count" value="{{$medicine->count}}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Medicine</button>
            </form>
        </div>
    </div>
</div>
@endsection

</body>
</html>