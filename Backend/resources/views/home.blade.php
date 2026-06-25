<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <style>
        body {
            background-color: #f5f5f5;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .sidebar {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .sidebar a {
            display: block;
            padding: 10px;
            margin: 5px 0;
            text-decoration: none;
            color: #333;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: #f0f0f0;
        }
        .content-section {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/home">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Welcome, {{ session('user_name') }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar">
                    <h5>Menu</h5>
                    <a href="/home">Dashboard</a>
                    <a href="/users">User Management</a>
                    <a href="/feed">Feed</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="content-section">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <h2>Welcome to Dashboard</h2>
                    <p>Hello {{ session('user_name') }}, you are logged in!</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">User Profile</h5>
                                    <p class="card-text"><strong>Username:</strong> {{ $user->user_name }}</p>
                                    <p class="card-text"><strong>Email:</strong> {{ $user->user_email }}</p>
                                    <p class="card-text"><strong>Role:</strong> {{ $user->user_role }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Quick Links</h5>
                                    <a href="/users" class="btn btn-primary btn-sm">Manage Users</a>
                                    <a href="/feed" class="btn btn-info btn-sm">View Feed</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
