<?php

namespace App\Http\Controllers;

use App\Services\TMDBService;
use App\Services\AniListService;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(TMDBService $tmdb, AniListService $anilist)
    {
        // Hero Slider Data (mixed movies, TV, anime)
        $heroSlides = Cache::remember('hero_slides', 21600, function () use ($tmdb, $anilist) {
            $movies = $tmdb->getTopRated('movie');
            $tv = $tmdb->getTopRated('tv');
            $anime = $anilist->getTopRatedAnime(5);
            
            $all = collect();
            
            // Add movies
            foreach (array_slice($movies, 0, 4) as $movie) {
                $all->push(array_merge($movie, ['type' => 'movie']));
            }
            
            // Add TV shows
            foreach (array_slice($tv, 0, 3) as $show) {
                $all->push(array_merge($show, ['type' => 'tv']));
            }
            
            // Add anime
            foreach ($anime as $animeItem) {
                $all->push(array_merge($animeItem, ['type' => 'anime']));
            }
            
            return $all->shuffle()->all();
        });

        // Home sections
        $trending = $tmdb->getTrending('all', 'week');
        $popularMovies = $tmdb->getPopular('movie');
        $popularTv = $tmdb->getPopular('tv');
        $popularAnime = $anilist->getTrendingAnime(10);

        return view('home', compact(
            'heroSlides', 
            'trending', 
            'popularMovies', 
            'popularTv', 
            'popularAnime'
        ));
    }
}