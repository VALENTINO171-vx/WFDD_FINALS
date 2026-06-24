<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>View User</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container-fluid">
            <a class="navbar-brand" href="/home">Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">{{ session('user_name') }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>User Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><strong>ID:</strong></label>
                            <p>{{ $user->user_id }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Username:</strong></label>
                            <p>{{ $user->user_name }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Email:</strong></label>
                            <p>{{ $user->user_email }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Role:</strong></label>
                            <p><span class="badge bg-{{ $user->user_role == 'admin' ? 'danger' : 'primary' }}">{{ ucfirst($user->user_role) }}</span></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Created:</strong></label>
                            <p>{{ $user->created_at->format('Y-m-d H:i:s') }}</p>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="/users/{{ $user->user_id }}/edit" class="btn btn-warning">Edit</a>
                            <a href="/users" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
