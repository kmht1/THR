<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AniListService
{
    private $graphqlUrl = 'https://graphql.anilist.co';

    public function getTrendingAnime($perPage = 10)
    {
        return Cache::remember('trending_anime', 3600, function () use ($perPage) {
            $query = '
                query ($perPage: Int) {
                    Page(perPage: $perPage) {
                        media(type: ANIME, sort: TRENDING_DESC, status: RELEASING) {
                            id
                            title {
                                english
                                romaji
                            }
                            coverImage {
                                large
                            }
                            bannerImage
                            averageScore
                            description
                            episodes
                            status
                        }
                    }
                }
            ';

            $response = Http::post($this->graphqlUrl, [
                'query' => $query,
                'variables' => ['perPage' => $perPage]
            ]);

            return $response->successful() ? $response->json()['data']['Page']['media'] : [];
        });
    }

    public function getTopRatedAnime($perPage = 5)
    {
        return Cache::remember('top_rated_anime', 7200, function () use ($perPage) {
            $query = '
                query ($perPage: Int) {
                    Page(perPage: $perPage) {
                        media(type: ANIME, sort: SCORE_DESC) {
                            id
                            title {
                                english
                                romaji
                            }
                            coverImage {
                                large
                            }
                            bannerImage
                            averageScore
                            description(asHtml: false)
                        }
                    }
                }
            ';

            $response = Http::post($this->graphqlUrl, [
                'query' => $query,
                'variables' => ['perPage' => $perPage]
            ]);

            return $response->successful() ? $response->json()['data']['Page']['media'] : [];
        });
    }

    public function searchAnime($query)
    {
        return Cache::remember("anime_search_{$query}", 1800, function () use ($query) {
            $graphqlQuery = '
                query ($search: String) {
                    Page(perPage: 10) {
                        media(type: ANIME, search: $search) {
                            id
                            title {
                                english
                                romaji
                            }
                            coverImage {
                                large
                            }
                            averageScore
                            description
                        }
                    }
                }
            ';

            $response = Http::post($this->graphqlUrl, [
                'query' => $graphqlQuery,
                'variables' => ['search' => $query]
            ]);

            return $response->successful() ? $response->json()['data']['Page']['media'] : [];
        });
    }
}