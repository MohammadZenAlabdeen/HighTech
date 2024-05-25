<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>User Info</title>
</head>
<body>
    @extends('layout')
    @section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Information') }}</div>
                <div class="card-body">
                    <p><strong>{{ __('Name:') }}</strong> {{ $user->name }}</p>
                    <p><strong>{{ __('Email:') }}</strong> {{ $user->email }}</p>
                    <p><strong>{{ __('Creation Date:') }}</strong> {{ $user->created_at }}</p>
                    <p><strong>{{ __('Last Updated:') }}</strong> {{ $user->updated_at }}</p>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('Users.edit', $user->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                        <form action="{{ route('Users.delete', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this user?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
