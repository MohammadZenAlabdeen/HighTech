<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .m-container{
            height: 100vh;
        }
        .password-fields {
            display: none;
        }
    </style>
    <title>Document</title>
</head>
<body>
    @extends('layout')
    @section('content')
<div class="container m-container">
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Update') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('Users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="changePasswordCheckbox">
                            <label class="form-check-label" for="changePasswordCheckbox">
                                {{ __('Change Password') }}
                            </label>
                        </div>

                        <div class="password-fields @if(old('changePasswordCheckbox')) block @else none @endif">
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new-password">
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="new_password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="d-flex flex-column w-100 text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('changePasswordCheckbox').addEventListener('change', function () {
        var passwordFields = document.querySelector('.password-fields');
        if (this.checked) {
            passwordFields.style.display = 'block';
            document.getElementById('password').setAttribute('required', 'required');
            document.getElementById('password-confirm').setAttribute('required', 'required');
        } else {
            passwordFields.style.display = 'none';
            document.getElementById('password').removeAttribute('required');
            document.getElementById('password-confirm').removeAttribute('required');
        }
    });
</script>
@endsection

</body>
</html>