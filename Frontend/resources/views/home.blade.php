<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Restau-Rant</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-between p-6">

    <header class="bg-orange-500 shadow-md rounded-3xl p-5 flex justify-between items-center mb-8">
        <a href="{{ url('/home') }}" class="block transition-transform active:scale-95">
            <div class="px-6 py-3 font-bold text-xl bg-white text-orange-600 shadow-sm rounded-xl">
                Restau-Rant
            </div>
        </a>
        
        <form action="{{ url('/home') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Bar" class="px-5 py-2.5 bg-white text-black outline-none w-72 shadow-inner rounded-xl focus:ring-2 focus:ring-orange-300 transition-all">
            <button type="submit" class="px-6 py-2.5 bg-white text-black font-semibold hover:bg-orange-600 hover:text-white transition-all duration-200 cursor-pointer shadow-sm rounded-xl">
                Search
            </button>
        </form>
    </header>

    <main class="bg-gray-50 shadow-md rounded-3xl p-8 flex-grow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            @if(empty($restaurants))
                <div class="col-span-1 md:col-span-3 text-center py-12 text-gray-500 font-medium">
                    No restaurants found.
                </div>
            @else
                @foreach($restaurants as $resto)
                    <a href="{{ route('restaurant.details', $resto['restaurant_id']) }}" class="group block flex flex-col bg-white border border-gray-200 shadow-sm hover:shadow-xl rounded-2xl overflow-hidden transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 ease-in-out">
                        <div class="p-4 font-bold text-gray-800 text-center border-b border-gray-100 group-hover:text-orange-500 transition-colors">
                            {{ $resto['restaurant_name'] ?? 'Unnamed Restaurant' }}
                        </div>
                        
                        <div class="h-48 overflow-hidden bg-gray-100">
                            @if(!empty($resto['restaurant_image']))
                                <img src="{{ $resto['restaurant_image'] }}" alt="{{ $resto['restaurant_name'] }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=500&auto=format&fit=crop&q=60" alt="Default Image" class="w-full h-full object-cover">
                            @endif
                        </div>
                        
                        <div class="p-4 text-sm text-gray-600">
                            {{ Str::limit($resto['restaurant_description'] ?? 'No description available', 80) }}
                        </div>
                    </a>
                @endforeach
            @endif

        </div>
    </main>

    <footer class="bg-orange-500 shadow-md rounded-2xl p-4 text-center text-sm font-bold text-white tracking-wide">
        Copyright &copy; 2026 Restau-Rant
    </footer>

</body>
</html>