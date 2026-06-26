<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>{{ $restaurant['restaurant_name'] ?? 'Restaurant Details' }}</title>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto p-6">
        <div class="mb-6 flex items-center justify-between gap-4">
            <a href="{{ url('/home') }}" class="text-orange-600 font-semibold hover:underline">&larr; Back to home</a>
            <h1 class="text-3xl font-bold text-gray-900">{{ $restaurant['restaurant_name'] ?? 'Restaurant Details' }}</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-8">
            <section class="space-y-6">
                <div class="rounded-3xl overflow-hidden bg-white shadow-md">
                    @if(!empty($restaurant['restaurant_image']))
                        <img src="{{ $restaurant['restaurant_image'] }}" alt="{{ $restaurant['restaurant_name'] }}" class="w-full h-96 object-cover">
                    @else
                        <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=1200&auto=format&fit=crop&q=60" alt="Restaurant image" class="w-full h-96 object-cover">
                    @endif
                    <div class="p-8">
                        <div class="flex flex-wrap gap-3 mb-4">
                            <span class="inline-flex px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-sm font-medium">{{ $restaurant['restaurant_cuisine'] ?? 'Cuisine not set' }}</span>
                            <span class="inline-flex px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm">{{ $restaurant['restaurant_address'] ?? 'Address unavailable' }}</span>
                        </div>
                        <p class="text-gray-700 leading-relaxed mb-4">{{ $restaurant['restaurant_description'] ?? 'No description available.' }}</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div>
                                <h3 class="font-semibold text-gray-800">Phone</h3>
                                <p>{{ $restaurant['restaurant_phone'] ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Restaurant ID</h3>
                                <p>{{ $restaurant['restaurant_id'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl bg-white shadow-md p-6">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Menu</h2>
                    @if(!empty($restaurant['menus']) && count($restaurant['menus']) > 0)
                        <div class="space-y-4">
                            @foreach($restaurant['menus'] as $menu)
                                <div class="rounded-2xl border border-gray-200 p-4 hover:border-orange-300 transition">
                                    <div class="flex items-center justify-between gap-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $menu['menu_item_name'] ?? 'Menu Item' }}</h3>
                                            <p class="text-sm text-gray-600">{{ $menu['menu_item_description'] ?? 'No description' }}</p>
                                            <p class="text-sm text-gray-500 mt-1">Category: {{ $menu['menu_item_category'] ?? 'Uncategorized' }}</p>
                                            <p class="text-sm font-medium mt-2">
                                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ !empty($menu['menu_item_available']) && $menu['menu_item_available'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                    {{ !empty($menu['menu_item_available']) && $menu['menu_item_available'] ? 'Available' : 'Unavailable' }}
                                                </span>
                                            </p>

                                        </div>
                                        <span class="text-orange-600 font-bold">₱{{ number_format($menu['menu_item_price'] ?? 0, 2) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No menu items found for this restaurant.</p>
                    @endif
                </div>
            </section>

            <aside class="space-y-6">
                <div class="rounded-3xl bg-white shadow-md p-6">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Leave a review</h2>
                    @if(session('success'))
                        <div class="rounded-xl bg-green-50 border border-green-200 text-green-700 px-4 py-3 mb-4">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3 mb-4">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('restaurant.reviews.submit', $restaurant['restaurant_id']) }}" method="POST" class="space-y-4">
                        @csrf
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
                    @if(!empty($restaurant['reviews']) && count($restaurant['reviews']) > 0)
                        <div class="space-y-4">
                            @foreach($restaurant['reviews'] as $review)
                                <div class="rounded-2xl border border-gray-200 p-4">
                                    <div class="flex flex-wrap items-center justify-between mb-2 gap-4">
                                        <span class="font-semibold text-gray-900">{{ $review['user']['user_name'] ?? 'Guest' }}</span>
                                        <span class="text-orange-600 font-bold">{{ $review['review_rating'] ?? '0' }}/5</span>
                                    </div>
                                    <p class="text-gray-700 mb-3">{{ $review['review_comment'] ?? 'No comment provided.' }}</p>

                                    @php
                                        $isAuthor = session('user_id') === ($review['user']['user_id'] ?? null);
                                        $isAdmin = strtolower(session('user_role') ?? '') === 'admin';
                                    @endphp

                                    @if($isAuthor || $isAdmin)
                                        <div class="flex flex-wrap gap-3">
                                            <form action="{{ route('restaurant.reviews.update', ['restaurantId' => $restaurant['restaurant_id'], 'reviewId' => $review['review_id']]) }}" method="POST" class="flex flex-wrap gap-2 w-full">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="review_rating" min="1" max="5" value="{{ old('review_rating', $review['review_rating'] ?? 5) }}" class="w-20 rounded-2xl border border-gray-300 px-3 py-2 focus:border-orange-500 focus:ring-orange-500" required>
                                                <textarea name="review_comment" rows="2" class="flex-1 rounded-2xl border border-gray-300 px-3 py-2 focus:border-orange-500 focus:ring-orange-500">{{ old('review_comment', $review['review_comment'] ?? '') }}</textarea>
                                                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">Save</button>
                                            </form>
                                            <form action="{{ route('restaurant.reviews.destroy', ['restaurantId' => $restaurant['restaurant_id'], 'reviewId' => $review['review_id']]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No reviews yet. Be the first to review this restaurant.</p>
                    @endif
                </div>
            </aside>
        </div>
    </div>
        <footer class="bg-orange-500 shadow-md rounded-2xl p-4 text-center text-sm font-bold text-white tracking-wide">
        Copyright &copy; 2026 Restau-Rant
    </footer>
</body>
</html>