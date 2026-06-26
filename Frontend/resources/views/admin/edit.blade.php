<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>{{ isset($restaurant) ? 'Edit Restaurant' : 'Add Restaurant' }}</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-between p-6">
    
    <!-- Header -->
    <header class="bg-orange-500 shadow-md rounded-3xl p-5 flex justify-between items-center mb-8">
        <a href="{{ url('/admin') }}" class="block transition-transform active:scale-95">
            <div class="px-6 py-3 font-bold text-xl bg-white text-orange-600 shadow-sm rounded-xl">
                Admin Panel
            </div>
        </a>
        
        <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 bg-white text-orange-600 font-semibold hover:bg-orange-100 transition-all duration-200 cursor-pointer shadow-sm rounded-xl">
            <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
        </a>
    </header>

    <!-- Main Content -->
    <main class="bg-gray-50 shadow-md rounded-3xl p-8 flex-grow mb-6">
        <div class="max-w-2xl mx-auto">
            <!-- Display success/error messages -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg border border-red-400">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-md p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-{{ isset($restaurant) ? 'edit' : 'plus' }} text-orange-500 mr-2"></i>
                    {{ isset($restaurant) ? 'Edit Restaurant' : 'Add New Restaurant' }}
                </h2>
                <p class="text-gray-600 mb-8">{{ isset($restaurant) ? 'Update restaurant details' : 'Create a new restaurant entry' }}</p>

                <form action="{{ isset($restaurant) ? route('restaurants.update', $restaurant->restaurant_id) : route('restaurants.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if(isset($restaurant))
                        @method('PUT')
                    @endif

                    <!-- Name Field -->
                    <div>
                        <label for="restaurant_name" class="block text-sm font-semibold text-gray-700 mb-2">Restaurant Name *</label>
                        <input 
                            type="text" 
                            id="restaurant_name" 
                            name="restaurant_name" 
                            placeholder="Enter restaurant name" 
                            value="{{ isset($restaurant) ? $restaurant->restaurant_name : old('restaurant_name') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                            required
                        >
                        @error('restaurant_name')
                            <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address Field -->
                    <div>
                        <label for="restaurant_address" class="block text-sm font-semibold text-gray-700 mb-2">Address *</label>
                        <input 
                            type="text" 
                            id="restaurant_address" 
                            name="restaurant_address" 
                            placeholder="Enter restaurant address" 
                            value="{{ isset($restaurant) ? $restaurant->restaurant_address : old('restaurant_address') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                            required
                        >
                        @error('restaurant_address')
                            <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Phone Number Field -->
                        <div>
                            <label for="restaurant_phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                            <input 
                                type="tel" 
                                id="restaurant_phone" 
                                name="restaurant_phone" 
                                placeholder="Enter phone number" 
                                value="{{ isset($restaurant) ? $restaurant->restaurant_phone : old('restaurant_phone') }}" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                            >
                            @error('restaurant_phone')
                                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cuisine Type Field -->
                        <div>
                            <label for="restaurant_cuisine" class="block text-sm font-semibold text-gray-700 mb-2">Cuisine Type</label>
                            <input 
                                type="text" 
                                id="restaurant_cuisine" 
                                name="restaurant_cuisine" 
                                placeholder="e.g., Italian, Asian, Mexican" 
                                value="{{ isset($restaurant) ? $restaurant->restaurant_cuisine : old('restaurant_cuisine') }}" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                            >
                            @error('restaurant_cuisine')
                                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description Field -->
                    <div>
                        <label for="restaurant_description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <textarea 
                            id="restaurant_description" 
                            name="restaurant_description" 
                            placeholder="Enter restaurant description" 
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition resize-none"
                        >{{ isset($restaurant) ? $restaurant->restaurant_description : old('restaurant_description') }}</textarea>
                        @error('restaurant_description')
                            <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Field -->
                    <div>
                        <label for="restaurant_image" class="block text-sm font-semibold text-gray-700 mb-2">Restaurant Image</label>
                        <div class="flex items-center gap-4">
                            <input 
                                type="file" 
                                id="restaurant_image" 
                                name="restaurant_image" 
                                accept="image/*"
                                class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                            >
                            @if(isset($restaurant) && $restaurant->restaurant_image)
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('storage/' . $restaurant->restaurant_image) }}" alt="{{ $restaurant->restaurant_name }}" class="w-20 h-20 rounded-lg object-cover shadow-sm border border-gray-200">
                                </div>
                            @endif
                        </div>
                        @error('restaurant_image')
                            <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-8 border-t border-gray-200">
                        <button 
                            type="submit" 
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white font-semibold rounded-xl transition shadow-md"
                        >
                            <i class="fas fa-{{ isset($restaurant) ? 'save' : 'plus' }} mr-2"></i>{{ isset($restaurant) ? 'Update Restaurant' : 'Add Restaurant' }}
                        </button>
                        <a 
                            href="{{ route('admin.dashboard') }}" 
                            class="flex-1 px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-xl transition text-center shadow-md"
                        >
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-orange-500 shadow-md rounded-2xl p-4 text-center text-sm font-bold text-white tracking-wide">
        Copyright &copy; 2026 Restau-Rant Admin Panel
    </footer>

</body>
</html>
