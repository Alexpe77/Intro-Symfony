<?php

namespace App\Controller;

use Psr\Cache\CacheItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Twig\Environment;


class VinylController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(Environment $twig): Response
    {

        $tracks = [
            ['song' => 'No Gods, No Masters', 'artist' => 'Machine Head'],
            ['song' => 'Pisces', 'artist' => 'Jinjer'],
            ['song' => 'Around The Fur', 'artist' => 'Deftones'],
            ['song' => 'Rose Tattoo', 'artist' => 'Dropkick Murphys'],
            ['song' => 'Here Comes The Boom', 'artist' => 'Rise Of The Northstar'],
        ];

        $html = $twig->render('vinyl/homepage.html.twig', [
            'title' => 'Favourite Mix',
            'tracks' => $tracks,
        ]);

        return new Response($html);
    }

    #[Route('/browse/{slug}', name: 'app_browse')]
    public function browse(HttpClientInterface $httpClient, CacheInterface $cache, string $slug = null): Response
    {

        $genre = $slug ? str_replace('-', ' ', $slug) : null;
        $mixes = $cache->get('mixes_data', function(CacheItemInterface $cacheItem) use($httpClient) {
            $cacheItem->expiresAfter(5);
            $response = $httpClient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');

            return $response->toArray();
        });

        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }
}
