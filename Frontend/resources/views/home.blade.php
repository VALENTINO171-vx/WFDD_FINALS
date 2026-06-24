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
    <a href="{{ url('/') }}" class="block transition-transform active:scale-95">
    <div class="px-6 py-3 font-bold text-xl bg-white text-orange-600 shadow-sm rounded-xl">
        Restau-Rant
    </div>
</a>
    <form action="#" method="GET" class="flex gap-4">
        <input type="text" name="search" placeholder="Search Bar" class="px-5 py-2.5 bg-white text-black outline-none w-72 shadow-inner rounded-xl focus:ring-2 focus:ring-orange-300 transition-all">
        <button type="submit" class="px-6 py-2.5 bg-white text-black font-semibold hover:bg-white hover:text-orange-500 transition-all duration-200 cursor-pointer shadow-sm rounded-xl">
            Search
        </button>
    </form>
</header>

    <main class="bg-gray-300 shadow-md rounded-3xl p-8 flex-grow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="group flex flex-col bg-white shadow-sm hover:shadow-xl rounded-2xl overflow-hidden transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 ease-in-out cursor-pointer">
                <div class="p-4 font-bold text-gray-800 text-center border-b border-gray-100 group-hover:text-orange-500 transition-colors">Sate Ayam Madura Cak Umar</div>
                <div class="h-48 overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1544025162-d76694265947?w=500&auto=format&fit=crop&q=60" alt="Sate Ayam" class="w-full h-full object-cover">
                </div>
                <div class="p-3 text-sm font-medium text-center text-gray-500 bg-gray-50">124 Reviews</div>
            </div>

            <div class="group flex flex-col bg-white shadow-sm hover:shadow-xl rounded-2xl overflow-hidden transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 ease-in-out cursor-pointer">
                <div class="p-4 font-bold text-gray-800 text-center border-b border-gray-100 group-hover:text-orange-500 transition-colors">Ramen Ichiran Kyoto</div>
                <div class="h-48 overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=500&auto=format&fit=crop&q=60" alt="Ramen" class="w-full h-full object-cover">
                </div>
                <div class="p-3 text-sm font-medium text-center text-gray-500 bg-gray-50">89 Reviews</div>
            </div>

            <div class="group flex flex-col bg-white shadow-sm hover:shadow-xl rounded-2xl overflow-hidden transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 ease-in-out cursor-pointer">
                <div class="p-4 font-bold text-gray-800 text-center border-b border-gray-100 group-hover:text-orange-500 transition-colors">Burger & Co. Menteng</div>
                <div class="h-48 overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500&auto=format&fit=crop&q=60" alt="Burger" class="w-full h-full object-cover">
                </div>
                <div class="p-3 text-sm font-medium text-center text-gray-500 bg-gray-50">245 Reviews</div>
            </div>

            <div class="group flex flex-col bg-white shadow-sm hover:shadow-xl rounded-2xl overflow-hidden transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 ease-in-out cursor-pointer">
                <div class="p-4 font-bold text-gray-800 text-center border-b border-gray-100 group-hover:text-orange-500 transition-colors">Pizza Peperoni Da Vinci</div>
                <div class="h-48 overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=500&auto=format&fit=crop&q=60" alt="Pizza" class="w-full h-full object-cover">
                </div>
                <div class="p-3 text-sm font-medium text-center text-gray-500 bg-gray-50">67 Reviews</div>
            </div>

            <div class="group flex flex-col bg-white shadow-sm hover:shadow-xl rounded-2xl overflow-hidden transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 ease-in-out cursor-pointer">
                <div class="p-4 font-bold text-gray-800 text-center border-b border-gray-100 group-hover:text-orange-500 transition-colors">Sushi Tei Grand Indonesia</div>
                <div class="h-48 overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1579871494447-9811cf80d66c?w=500&auto=format&fit=crop&q=60" alt="Sushi" class="w-full h-full object-cover">
                </div>
                <div class="p-3 text-sm font-medium text-center text-gray-500 bg-gray-50">312 Reviews</div>
            </div>

            <div class="group flex flex-col bg-white shadow-sm hover:shadow-xl rounded-2xl overflow-hidden transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 ease-in-out cursor-pointer">
                <div class="p-4 font-bold text-gray-800 text-center border-b border-gray-100 group-hover:text-orange-500 transition-colors">Kopi Susu Jiwa Muda</div>
                <div class="h-48 overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=500&auto=format&fit=crop&q=60" alt="Coffee" class="w-full h-full object-cover">
                </div>
                <div class="p-3 text-sm font-medium text-center text-gray-500 bg-gray-50">42 Reviews</div>
            </div>

        </div>
    </main>

    <footer class="bg-orange-500 shadow-md rounded-2xl p-4 text-center text-sm font-bold text-white tracking-wide">
        Copyright &copy; 2026 Restau-Rant
    </footer>

</body>
</html>