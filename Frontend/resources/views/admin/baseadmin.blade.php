<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin Dashboard</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-between p-6">
    
    <!-- Header -->
    <header class="bg-orange-500 shadow-md rounded-3xl p-5 flex justify-between items-center mb-8">
        <a href="{{ url('/admin') }}" class="block transition-transform active:scale-95">
            <div class="px-6 py-3 font-bold text-xl bg-white text-orange-600 shadow-sm rounded-xl">
                Admin Panel
            </div>
        </a>
        
        <div class="flex items-center gap-4">
            <span class="text-white font-semibold">Welcome, {{ session('user_name') }}!</span>
            <a href="{{ url('/logout') }}" class="px-6 py-2.5 bg-white text-orange-600 font-semibold hover:bg-red-500 hover:text-white transition-all duration-200 cursor-pointer shadow-sm rounded-xl">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="bg-gray-50 shadow-md rounded-3xl p-8 flex-grow mb-6">
        <!-- Display success/error messages -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Restaurants Section -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6 pb-4 border-b-2 border-orange-500">
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-utensils text-orange-500 mr-2"></i>Restaurant Management
                </h2>
                <a href="{{ route('restaurants.create') }}" class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl transition text-sm font-semibold shadow-sm">
                    <i class="fas fa-plus mr-2"></i>Add Restaurant
                </a>
            </div>

            @if(empty($restaurants))
                <div class="bg-white p-8 rounded-2xl shadow-sm text-center text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-4 opacity-50"></i>
                    <p class="text-lg">No restaurants found</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($restaurants as $restaurant)
                        <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl overflow-hidden transition-all duration-300 transform hover:-translate-y-1">
                            <!-- Restaurant Card Header -->
                            <div class="bg-gradient-to-r from-orange-400 to-orange-500 p-4">
                                <h3 class="font-bold text-white text-lg truncate">{{ $restaurant['restaurant_name'] ?? 'N/A' }}</h3>
                            </div>

                            <!-- Card Body -->
                            <div class="p-4 space-y-3">
                                <div class="text-sm">
                                    <span class="text-gray-600 font-semibold">Cuisine:</span>
                                    <span class="text-gray-800 ml-2">{{ $restaurant['restaurant_cuisine'] ?? 'N/A' }}</span>
                                </div>
                                <div class="text-sm">
                                    <span class="text-gray-600 font-semibold">Phone:</span>
                                    <span class="text-gray-800 ml-2">{{ $restaurant['restaurant_phone'] ?? 'N/A' }}</span>
                                </div>
                                <div class="text-sm line-clamp-2">
                                    <span class="text-gray-600 font-semibold">Address:</span>
                                    <span class="text-gray-800 ml-2">{{ $restaurant['restaurant_address'] ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="p-4 border-t border-gray-100 flex gap-2">
                                <a href="{{ route('restaurants.show', $restaurant['restaurant_id']) }}" class="flex-1 px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg transition text-center font-semibold">
                                    <i class="fas fa-star mr-1"></i>Review
                                </a>
                                <a href="{{ route('restaurants.edit', $restaurant['restaurant_id']) }}" class="flex-1 px-3 py-2 bg-green-500 hover:bg-green-600 text-white text-sm rounded-lg transition text-center font-semibold">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <form action="{{ route('restaurants.destroy', $restaurant['restaurant_id']) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg transition font-semibold" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash mr-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Users Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-4 border-b-2 border-orange-500">
                <i class="fas fa-users text-orange-500 mr-2"></i>User Management
            </h2>

            @if(empty($users))
                <div class="bg-white p-8 rounded-2xl shadow-sm text-center text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-4 opacity-50"></i>
                    <p class="text-lg">No users found</p>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-orange-400 to-orange-500">
                                <tr>
                                    <th class="px-6 py-4 text-left font-semibold text-white">ID</th>
                                    <th class="px-6 py-4 text-left font-semibold text-white">Username</th>
                                    <th class="px-6 py-4 text-center font-semibold text-white">Status</th>
                                    <th class="px-6 py-4 text-center font-semibold text-white">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($users as $user)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-800">{{ $user['user_id'] }}</td>
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $user['user_name'] }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                                {{ $user['user_role'] ?? 'User' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center space-x-2">
                                            <form action="{{ route('users.toggle-blacklist', $user['user_id']) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold rounded-lg transition" title="Toggle Blacklist">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-orange-500 shadow-md rounded-2xl p-4 text-center text-sm font-bold text-white tracking-wide">
        Copyright &copy; 2026 Restau-Rant Admin Panel
    </footer>

</body>
</html>