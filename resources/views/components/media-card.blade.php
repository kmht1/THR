@props(['item', 'type' => null])

@php
    $title = $item['title'] ?? $item['name'] ?? $item['title']['english'] ?? $item['title']['romaji'] ?? 'Unknown';
    $image = $item['poster_path'] ?? $item['coverImage']['large'] ?? null;
    $rating = $item['vote_average'] ?? ($item['averageScore'] ? $item['averageScore'] / 10 : null);
    $mediaType = $type ?? $item['media_type'] ?? 'movie';
    $id = $item['id'] ?? null;
@endphp

<div class="group cursor-pointer transform transition-transform hover:scale-105">
    <a href="{{ $id ? route("{$mediaType}.show", $id) : '#' }}">
        <div class="relative overflow-hidden rounded-lg bg-gray-700 aspect-[2/3]">
            @if($image)
                <img 
                    src="{{ str_contains($image, 'http') ? $image : "https://image.tmdb.org/t/p/w500{$image}" }}" 
                    alt="{{ $title }}"
                    class="w-full h-full object-cover group-hover:opacity-80 transition-opacity"
                    loading="lazy"
                >
            @else
                <div class="w-full h-full flex items-center justify-center bg-gray-600">
                    <span class="text-gray-400">No Image</span>
                </div>
            @endif
            
            <!-- Rating Badge -->
            @if($rating)
                <div class="absolute top-2 right-2 bg-black/80 text-white px-2 py-1 rounded text-sm font-semibold">
                    {{ number_format($rating, 1) }}
                </div>
            @endif
            
            <!-- Hover Overlay -->
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                <div class="text-center">
                    <div class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded font-semibold mb-2">
                        {{ __('Watch Now') }}
                    </div>
                    <p class="text-sm px-2 line-clamp-3">{{ $title }}</p>
                </div>
            </div>
        </div>
    </a>
    <h3 class="mt-2 text-sm font-semibold line-clamp-2 group-hover:text-red-400 transition-colors">
        {{ $title }}
    </h3>
</div>