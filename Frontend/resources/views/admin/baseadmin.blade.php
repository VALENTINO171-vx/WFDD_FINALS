<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin Dashboard</title>
</head>
<body class="bg-gray-100 py-5">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="bg-white p-5 mb-8 rounded-lg shadow-sm">
            <h1 class="text-3xl font-bold text-gray-800">{{ config('app.name', 'Nama App') }}</h1>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Restaurant List Section -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-5 pb-3 border-b-2 border-blue-500">Restaurant List</h2>
                <div class="overflow-x-auto rounded-lg">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-center font-semibold text-gray-600 border-b">ID</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-600 border-b">Name</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-600 border-b">Edit</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-600 border-b">Delete</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-600 border-b">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($restaurants ?? [] as $restaurant)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-center">{{ $restaurant->id }}</td>
                                    <td class="px-4 py-3 text-center">{{ $restaurant->name }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white text-sm rounded transition inline-block">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded transition" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('restaurants.show', $restaurant->id) }}" class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded transition inline-block">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">No restaurants found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- User List Section -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-5 pb-3 border-b-2 border-blue-500">User List</h2>
                <div class="overflow-x-auto rounded-lg">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-center font-semibold text-gray-600 border-b">ID</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-600 border-b">Name</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-600 border-b">Blacklist</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-600 border-b">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users ?? [] as $user)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-center">{{ $user->id }}</td>
                                    <td class="px-4 py-3 text-center">{{ $user->name }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <form action="{{ route('users.toggle-blacklist', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-gray-800 text-sm rounded transition">
                                                <i class="fas fa-ban"></i> {{ $user->is_blacklisted ? 'Unblacklist' : 'Blacklist' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded transition" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center text-gray-500 text-sm mt-10">
            <p>&copy; {{ date('Y') }} All Rights Reserved</p>
        </footer>
    </div>
</body>
</html>