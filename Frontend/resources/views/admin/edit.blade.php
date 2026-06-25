<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>{{ isset($restaurant) ? 'Edit Restaurant' : 'Add Restaurant' }}</title>
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="bg-white p-6 mb-8 rounded-lg shadow-sm">
            <h1 class="text-3xl font-bold text-gray-800">{{ config('app.name', 'Nama App') }}</h1>
        </div>

        <!-- Form Section -->
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-8">{{ isset($restaurant) ? 'Edit Restaurant' : 'Add Restaurant' }}</h2>

            <form action="{{ isset($restaurant) ? route('restaurants.update', $restaurant->restaurant_id) : route('restaurants.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if(isset($restaurant))
                    @method('PUT')
                @endif

                <!-- Name Field -->
                <div>
                    <label for="restaurant_name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input 
                        type="text" 
                        id="restaurant_name" 
                        name="restaurant_name" 
                        placeholder="Restaurant Name" 
                        value="{{ isset($restaurant) ? $restaurant->restaurant_name : old('restaurant_name') }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                    @error('restaurant_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Field -->
                <div>
                    <label for="restaurant_description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea 
                        id="restaurant_description" 
                        name="restaurant_description" 
                        placeholder="Restaurant Description" 
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >{{ isset($restaurant) ? $restaurant->restaurant_description : old('restaurant_description') }}</textarea>
                    @error('restaurant_description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cuisine Type Field -->
                <div>
                    <label for="restaurant_cuisine" class="block text-sm font-medium text-gray-700 mb-2">Cuisine Type</label>
                    <input 
                        type="text" 
                        id="restaurant_cuisine" 
                        name="restaurant_cuisine" 
                        placeholder="Cuisine Type" 
                        value="{{ isset($restaurant) ? $restaurant->restaurant_cuisine : old('restaurant_cuisine') }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                    @error('restaurant_cuisine')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address Field -->
                <div>
                    <label for="restaurant_address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <input 
                        type="text" 
                        id="restaurant_address" 
                        name="restaurant_address" 
                        placeholder="Restaurant Address" 
                        value="{{ isset($restaurant) ? $restaurant->restaurant_address : old('restaurant_address') }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                    @error('restaurant_address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number Field -->
                <div>
                    <label for="restaurant_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input 
                        type="tel" 
                        id="restaurant_phone" 
                        name="restaurant_phone" 
                        placeholder="Phone Number" 
                        value="{{ isset($restaurant) ? $restaurant->restaurant_phone : old('restaurant_phone') }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                    @error('restaurant_phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Field -->
                <div>
                    <label for="restaurant_image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                    <div class="flex items-center gap-4">
                        <input 
                            type="file" 
                            id="restaurant_image" 
                            name="restaurant_image" 
                            accept="image/*"
                            class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        @if(isset($restaurant) && $restaurant->restaurant_image)
                            <img src="{{ asset('storage/' . $restaurant->restaurant_image) }}" alt="{{ $restaurant->restaurant_name }}" class="w-16 h-16 rounded object-cover">
                        @endif
                    </div>
                    @error('restaurant_image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-6">
                    <button 
                        type="submit" 
                        class="flex-1 px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-full transition"
                    >
                        <i class="fas fa-save mr-2"></i>{{ isset($restaurant) ? 'Update Restaurant' : 'Add Restaurant' }}
                    </button>
                    <a 
                        href="{{ route('admin.dashboard') }}" 
                        class="flex-1 px-6 py-3 bg-gray-400 hover:bg-gray-500 text-white font-semibold rounded-full transition text-center"
                    >
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
