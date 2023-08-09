
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-2xl font-semibold mb-4">{{ Auth::user()->name }}</h2>
            <p class="text-gray-600 mb-2">{{ Auth::user()->email }}</p>
            <!-- Ajoutez ici d'autres informations de l'utilisateur à afficher -->
        </div>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <a href="{{ route('calendar.index') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700">Calendrier de réservation</a>
</div>
