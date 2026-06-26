<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>{{ $restaurant->restaurant_name ?? 'Restaurant Details' }}</title>
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
        <div class="max-w-3xl mx-auto">
            <!-- Restaurant Details Section -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-orange-400 to-orange-500 p-6">
                    <h2 class="text-3xl font-bold text-white">{{ $restaurant->restaurant_name ?? 'N/A' }}</h2>
                </div>

                <div class="p-8 space-y-8">
                    <!-- Image Section -->
                    @if(isset($restaurant->restaurant_image))
                        <div class="rounded-xl overflow-hidden shadow-md">
                            <img src="{{ asset('storage/' . $restaurant->restaurant_image) }}" alt="{{ $restaurant->restaurant_name }}" class="w-full h-96 object-cover">
                        </div>
                    @else
                        <div class="rounded-xl overflow-hidden shadow-md bg-gray-200 h-96 flex items-center justify-center">
                            <div class="text-center text-gray-500">
                                <i class="fas fa-image text-4xl mb-2"></i>
                                <p>No image available</p>
                            </div>
                        </div>
                    @endif

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- ID -->
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <h3 class="text-xs font-bold text-gray-500 uppercase mb-2 tracking-wider">Restaurant ID</h3>
                                <p class="text-lg font-semibold text-gray-800">{{ $restaurant->restaurant_id ?? 'N/A' }}</p>
                            </div>

                            <!-- Phone -->
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <h3 class="text-xs font-bold text-gray-500 uppercase mb-2 tracking-wider">Phone</h3>
                                <p class="text-lg font-semibold text-gray-800">
                                    <i class="fas fa-phone text-orange-500 mr-2"></i>{{ $restaurant->restaurant_phone ?? 'N/A' }}
                                </p>
                            </div>

                            <!-- Cuisine -->
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <h3 class="text-xs font-bold text-gray-500 uppercase mb-2 tracking-wider">Cuisine Type</h3>
                                <p class="text-lg font-semibold text-gray-800">
                                    <i class="fas fa-utensils text-orange-500 mr-2"></i>{{ $restaurant->restaurant_cuisine ?? 'N/A' }}
                                </p>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Address -->
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <h3 class="text-xs font-bold text-gray-500 uppercase mb-2 tracking-wider">Address</h3>
                                <p class="text-gray-800 leading-relaxed">
                                    <i class="fas fa-map-marker-alt text-orange-500 mr-2"></i>{{ $restaurant->restaurant_address ?? 'N/A' }}
                                </p>
                            </div>

                            <!-- Description -->
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <h3 class="text-xs font-bold text-gray-500 uppercase mb-2 tracking-wider">Description</h3>
                                <p class="text-gray-800 leading-relaxed text-sm">
                                    {{ $restaurant->restaurant_description ?? 'No description available' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Section -->
                    <div class="rounded-3xl bg-white shadow-md p-6 mt-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Menu</h2>
                        @if(!empty($restaurant->menus) && count($restaurant->menus) > 0)
                            <div class="space-y-4">
                                @foreach($restaurant->menus as $menu)
                                    <div class="rounded-2xl border border-gray-200 p-4 hover:border-orange-300 transition">
                                        <div class="flex items-center justify-between gap-4">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">{{ $menu->menu_item_name ?? 'Menu Item' }}</h3>
                                                <p class="text-sm text-gray-600">{{ $menu->menu_item_description ?? 'No description' }}</p>
                                                <p class="text-sm text-gray-500 mt-1">Category: {{ $menu->menu_item_category ?? 'Uncategorized' }}</p>
                                                <p class="text-sm font-medium mt-2">
                                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ !empty($menu->menu_item_available) && $menu->menu_item_available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                        {{ !empty($menu->menu_item_available) && $menu->menu_item_available ? 'Available' : 'Unavailable' }}
                                                    </span>
                                                </p>
                                            </div>
                                            <span class="text-orange-600 font-bold">₱{{ number_format($menu->menu_item_price ?? 0, 2) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No menu items found for this restaurant.</p>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-8 border-t border-gray-200">
                        <a href="{{ route('restaurants.edit', $restaurant->restaurant_id) }}" class="flex-1 px-6 py-3 bg-gradient-to-r from-green-400 to-green-500 hover:from-green-500 hover:to-green-600 text-white font-semibold rounded-xl transition shadow-md text-center">
                            <i class="fas fa-edit mr-2"></i>Edit Restaurant
                        </a>
                        <form action="{{ route('restaurants.destroy', $restaurant->restaurant_id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-semibold rounded-xl transition shadow-md" onclick="return confirm('Are you sure you want to delete this restaurant?')">
                                <i class="fas fa-trash mr-2"></i>Delete Restaurant
                            </button>
                        </form>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-10">
                        <div class="rounded-3xl bg-white shadow-md p-6">
                            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Leave a review</h2>
                            @if(session('success'))
                                <div class="rounded-xl bg-green-50 border border-green-200 text-green-700 px-4 py-3 mb-4">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3 mb-4">{{ session('error') }}</div>
                            @endif
                            <form action="{{ route('restaurant.reviews.submit', $restaurant->restaurant_id) }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="admin" value="1">
                                <div>
                                    <label for="review_rating" class="block text-sm font-medium text-gray-700">Rating (1-5)</label>
                                    <input type="number" name="review_rating" id="review_rating" min="1" max="5" value="{{ old('review_rating', 5) }}" class="mt-1 block w-full rounded-2xl border border-gray-300 px-4 py-3 focus:border-orange-500 focus:ring-orange-500" required>
                                    @error('review_rating')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="review_comment" class="block text-sm font-medium text-gray-700">Comment</label>
                                    <textarea name="review_comment" id="review_comment" rows="5" class="mt-1 block w-full rounded-2xl border border-gray-300 px-4 py-3 focus:border-orange-500 focus:ring-orange-500">{{ old('review_comment') }}</textarea>
                                    @error('review_comment')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                                <button type="submit" class="w-full inline-flex justify-center rounded-2xl bg-orange-600 px-4 py-3 font-semibold text-white hover:bg-orange-700 transition">Submit review</button>
                            </form>
                        </div>

                        <div class="rounded-3xl bg-white shadow-md p-6">
                            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Reviews</h2>
                            @if(!empty($restaurant->reviews) && count($restaurant->reviews) > 0)
                                <div class="space-y-4">
                                    @foreach($restaurant->reviews as $review)
                                        @php
                                            $isAuthor = session('user_id') === ($review->user->user_id ?? null);
                                            $isAdmin = strtolower(session('user_role') ?? '') === 'admin';
                                        @endphp
                                        <div class="rounded-2xl border border-gray-200 p-4">
                                            <div class="flex items-center justify-between mb-2 gap-4">
                                                <span class="font-semibold text-gray-900">{{ $review->user->user_name ?? 'Guest' }}</span>
                                                <span class="text-orange-600 font-bold">{{ $review->review_rating ?? '0' }}/5</span>
                                            </div>
                                            <p class="text-gray-700 mb-3">{{ $review->review_comment ?? 'No comment provided.' }}</p>

                                            @if($isAuthor)
                                                <div class="flex flex-wrap gap-3">
                                                    <form action="{{ route('restaurant.reviews.update', ['restaurantId' => $restaurant->restaurant_id, 'reviewId' => $review->review_id]) }}" method="POST" class="flex flex-wrap gap-2 w-full">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="admin" value="1">
                                                        <input type="number" name="review_rating" min="1" max="5" value="{{ old('review_rating', $review->review_rating ?? 5) }}" class="w-20 rounded-2xl border border-gray-300 px-3 py-2 focus:border-orange-500 focus:ring-orange-500" required>
                                                        <textarea name="review_comment" rows="2" class="flex-1 rounded-2xl border border-gray-300 px-3 py-2 focus:border-orange-500 focus:ring-orange-500">{{ old('review_comment', $review->review_comment ?? '') }}</textarea>
                                                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">Save</button>
                                                    </form>
                                                    <form action="{{ route('restaurant.reviews.destroy', ['restaurantId' => $restaurant->restaurant_id, 'reviewId' => $review->review_id]) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="admin" value="1">
                                                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition">Delete</button>
                                                    </form>
                                                </div>
                                            @elseif($isAdmin)
                                                <form action="{{ route('restaurant.reviews.destroy', ['restaurantId' => $restaurant->restaurant_id, 'reviewId' => $review->review_id]) }}" method="POST" class="inline-flex">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="admin" value="1">
                                                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition">Delete</button>
                                                </form>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500">No reviews yet. Be the first to review this restaurant.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-orange-500 shadow-md rounded-2xl p-4 text-center text-sm font-bold text-white tracking-wide">
        Copyright &copy; 2026 Restau-Rant Admin Panel
    </footer>

</body>
</html>
