<?php

namespace App\Http\Controllers;

class PlayerController extends Controller
{
    private $servers = [
        'vidsrc' => [
            'name' => 'VidSrc Primary',
            'label' => 'Good • Adblock Needed',
            'url' => 'https://vidsrc.xyz/embed/',
            'type' => 'tmdb'
        ],
        'embedapi' => [
            'name' => 'Embed API',
            'label' => 'Good',
            'url' => 'https://player.embed-api.stream/?id=',
            'type' => 'tmdb'
        ],
        'vidsrc2' => [
            'name' => 'VidSrc Secondary',
            'label' => 'Medium',
            'url' => 'https://vidsrc.to/embed/',
            'type' => 'tmdb'
        ],
        'superembed' => [
            'name' => 'SuperEmbed',
            'label' => 'Low',
            'url' => 'https://multiembed.mov/?video_id=',
            'type' => 'tmdb'
        ]
    ];

    public function watch($type, $tmdbId)
    {
        $server = request()->get('server', 'embedapi');
        $serverConfig = $this->servers[$server] ?? $this->servers['embedapi'];
        
        $embedUrl = $serverConfig['url'] . ($type === 'movie' ? 'movie/' : 'tv/') . $tmdbId;

        return view('player.watch', compact('embedUrl', 'serverConfig', 'servers', 'type', 'tmdbId'));
    }
}