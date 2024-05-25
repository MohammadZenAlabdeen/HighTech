<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .wrapper {
            display: flex;
            flex: 1;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            min-height: 100vh;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                @if(auth()->user()->is_admin==true)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('Users.index')}}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('Pharmacies.index')}}">Pharmacies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('PharmaciesRegisters.index')}}">Pharmacy applications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('pharmacy.medicines.all')}}">All medicines</a>
                </li>
                @endif
                @if (auth()->user()->pharmacy)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('Phamracies.show',auth()->user()->pharmacy)}}">My pharmacy</a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('pharmacy.medicines.index',auth()->user()->pharmacy)}}">My medicines</a>
                </li> 
                @endif
                @if(auth()->user()->pharmacyRegister)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">My pharmacy application</a>
                </li>                
                @endif
                <li class="nav-item">
                    <form method="POST" action="{{route('Users.logout')}}" class="nav-link">
                        @csrf
                    <button type="submit" class="nav-link" style="background: none; border:none; padding:0;">
                        Logout
                    </button>
                </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="wrapper">
        <div class="sidebar p-3">
            <h4>Sidebar</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('Users.show',auth()->user()->id)}}">Profile</a>
                </li>
                @if(auth()->user()->pharmacy)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('pharmacy.medicines.create',auth()->user()->pharmacy)}}">Add a medicine</a>
                </li>
                @endif
            </ul>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
