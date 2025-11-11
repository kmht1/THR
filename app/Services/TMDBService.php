<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TMDBService
{
    private $baseUrl = 'https://api.themoviedb.org/3';
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.api_key');
    }

    public function getTrending($type = 'all', $timeWindow = 'week')
    {
        return Cache::remember("trending_{$type}_{$timeWindow}", 3600, function () use ($type, $timeWindow) {
            $response = Http::withToken(config('services.tmdb.read_token'))
                ->get("{$this->baseUrl}/trending/{$type}/{$timeWindow}");

            return $response->successful() ? $response->json()['results'] : [];
        });
    }

    public function getTopRated($type = 'movie')
    {
        return Cache::remember("top_rated_{$type}", 7200, function () use ($type) {
            $response = Http::withToken(config('services.tmdb.read_token'))
                ->get("{$this->baseUrl}/{$type}/top_rated");

            return $response->successful() ? $response->json()['results'] : [];
        });
    }

    public function getPopular($type = 'movie')
    {
        return Cache::remember("popular_{$type}", 7200, function () use ($type) {
            $response = Http::withToken(config('services.tmdb.read_token'))
                ->get("{$this->baseUrl}/{$type}/popular");

            return $response->successful() ? $response->json()['results'] : [];
        });
    }

    public function getDetails($type, $id)
    {
        return Cache::remember("{$type}_{$id}_details", 10800, function () use ($type, $id) {
            $response = Http::withToken(config('services.tmdb.read_token'))
                ->get("{$this->baseUrl}/{$type}/{$id}", [
                    'append_to_response' => 'videos,credits,similar'
                ]);

            return $response->successful() ? $response->json() : null;
        });
    }

    public function search($query, $page = 1)
    {
        return Cache::remember("search_{$query}_{$page}", 1800, function () use ($query, $page) {
            $response = Http::withToken(config('services.tmdb.read_token'))
                ->get("{$this->baseUrl}/search/multi", [
                    'query' => $query,
                    'page' => $page
                ]);

            return $response->successful() ? $response->json()['results'] : [];
        });
    }
}