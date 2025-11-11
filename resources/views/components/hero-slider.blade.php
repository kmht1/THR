<div x-data="heroSlider()" class="relative h-[80vh] overflow-hidden">
    <!-- Slides -->
    <template x-for="(slide, index) in slides" :key="index">
        <div 
            x-show="currentSlide === index"
            x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-1000"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0"
        >
            <img 
                :src="getBackdropUrl(slide)" 
                :alt="getTitle(slide)"
                class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
            
            <!-- Slide Content -->
            <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                <div class="container mx-auto">
                    <span class="inline-block px-3 py-1 bg-primary/80 rounded-full text-sm mb-4" 
                          x-text="getTypeBadge(slide)"></span>
                    <h2 class="text-4xl font-bold mb-2" x-text="getTitle(slide)"></h2>
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-4">
                            <template x-for="i in 5" :key="i">
                                <svg :class="i <= getRating(slide) ? 'text-yellow-400' : 'text-gray-600'" 
                                     class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            </template>
                        </div>
                        <span x-text="getRating(slide) + '/10'"></span>
                    </div>
                    <p class="text-lg mb-6 max-w-2xl line-clamp-3" x-text="getDescription(slide)"></p>
                    <div class="flex space-x-4">
                        <a :href="getWatchUrl(slide)" 
                           class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg font-semibold flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            {{ __('Watch Now') }}
                        </a>
                        <a :href="getDetailUrl(slide)" 
                           class="bg-white/20 hover:bg-white/30 px-6 py-3 rounded-lg font-semibold backdrop-blur-sm">
                            {{ __('More Info') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Navigation -->
    <button @click="prevSlide()" 
            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-3 rounded-full">
        ‹
    </button>
    <button @click="nextSlide()" 
            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-3 rounded-full">
        ›
    </button>

    <!-- Dots -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="currentSlide = index" 
                    class="w-3 h-3 rounded-full transition-all"
                    :class="currentSlide === index ? 'bg-white' : 'bg-white/50'"></button>
        </template>
    </div>
</div>

<script>
function heroSlider() {
    return {
        slides: @json($heroSlides),
        currentSlide: 0,
        interval: null,
        
        init() {
            this.startAutoSlide();
        },
        
        startAutoSlide() {
            this.interval = setInterval(() => {
                this.nextSlide();
            }, 7000);
        },
        
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        },
        
        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
        },
        
        getBackdropUrl(slide) {
            if (slide.backdrop_path) {
                return `https://image.tmdb.org/t/p/w1280${slide.backdrop_path}`;
            }
            return slide.bannerImage || '/images/placeholder-backdrop.jpg';
        },
        
        getTitle(slide) {
            return slide.title || slide.name || slide.title?.english || slide.title?.romaji || 'Unknown Title';
        },
        
        getTypeBadge(slide) {
            if (slide.media_type === 'movie' || slide.type === 'movie') return 'Movie';
            if (slide.media_type === 'tv' || slide.type === 'tv') return 'TV Series';
            return 'Anime';
        },
        
        getRating(slide) {
            return Math.round((slide.vote_average || slide.averageScore / 10) * 10) / 10;
        },
        
        getDescription(slide) {
            return slide.overview || slide.description || 'No description available.';
        },
        
        getWatchUrl(slide) {
            const type = slide.media_type || slide.type || 'movie';
            const id = slide.id || slide.tmdb_id;
            return `/watch/${type}/${id}`;
        },
        
        getDetailUrl(slide) {
            const type = slide.media_type || slide.type || 'movie';
            const id = slide.id || slide.tmdb_id;
            return `/${type}/${id}`;
        }
    }
}
</script>