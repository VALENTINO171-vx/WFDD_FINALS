<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>{{ $restaurant->restaurant_name ?? 'Restaurant Details' }}</title>
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="bg-white p-6 mb-8 rounded-lg shadow-sm">
            <h1 class="text-3xl font-bold text-gray-800">{{ config('app.name', 'Nama App') }}</h1>
        </div>

        <!-- Restaurant Details Section -->
        <div class="bg-white p-8 rounded-lg shadow-md">
            <div class="flex justify-between items-start mb-8">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $restaurant->restaurant_name ?? 'N/A' }}</h2>
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Image -->
                    @if(isset($restaurant->restaurant_image))
                        <div class="rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $restaurant->restaurant_image) }}" alt="{{ $restaurant->restaurant_name }}" class="w-full h-96 object-cover">
                        </div>
                    @endif

                    <!-- Basic Info -->
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Restaurant ID</h3>
                            <p class="text-gray-800 text-lg">{{ $restaurant->restaurant_id ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Phone</h3>
                            <p class="text-gray-800 text-lg">{{ $restaurant->restaurant_phone ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Cuisine Type</h3>
                            <p class="text-gray-800 text-lg">{{ $restaurant->restaurant_cuisine ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Description -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Description</h3>
                        <p class="text-gray-800 leading-relaxed">{{ $restaurant->restaurant_description ?? 'No description available' }}</p>
                    </div>

                    <!-- Address -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Address</h3>
                        <p class="text-gray-800">{{ $restaurant->restaurant_address ?? 'N/A' }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-6">
                        <a href="{{ route('restaurants.edit', $restaurant->restaurant_id) }}" class="flex-1 px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition text-center">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        <form action="{{ route('restaurants.destroy', $restaurant->restaurant_id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash mr-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
