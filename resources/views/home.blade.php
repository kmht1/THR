<x-layouts.app>
    <!-- Hero Slider -->
    <section class="relative">
        <x-hero-slider :hero-slides="$heroSlides" />
    </section>

    <!-- Trending Now -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                <span class="text-red-500 mr-2">🔥</span>
                {{ __('Trending Now') }}
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach(array_slice($trending, 0, 10) as $item)
                    <x-media-card :item="$item" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Popular Movies -->
    <section class="py-12 bg-gray-800/50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                <span class="text-red-500 mr-2">🎬</span>
                {{ __('Popular Movies') }}
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach(array_slice($popularMovies, 0, 10) as $movie)
                    <x-media-card :item="$movie" type="movie" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Popular TV Shows -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                <span class="text-red-500 mr-2">📺</span>
                {{ __('Popular TV Shows') }}
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach(array_slice($popularTv, 0, 10) as $tv)
                    <x-media-card :item="$tv" type="tv" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Popular Anime -->
    <section class="py-12 bg-gray-800/50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                <span class="text-red-500 mr-2">⛩️</span>
                {{ __('Popular Anime') }}
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach(array_slice($popularAnime, 0, 10) as $anime)
                    <x-media-card :item="$anime" type="anime" />
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>