<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    public function browse(string $slug = null): Response
    {

        $genre = $slug ? str_replace('-', ' ', $slug) : null;
        $mixes = $this->getMixes();

        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }

    private function getMixes(): array {
        return [
            [
                'title' => 'PB & Jams',
                'trackCount' => 14,
                'genre' => 'Rock',
                'createdAt' => new \DateTime('2021-10-02'),
            ],
            [
                'title' => 'Put a Hex on your Ex',
                'trackCount' => 8,
                'genre' => 'Heavy Metal',
                'createdAt' => new \DateTime('2022-04-28'),
            ],
            [
                'title' => 'Spice Grills - Summer Tunes',
                'trackCount' => 10,
                'genre' => 'Pop',
                'createdAt' => new \DateTime('2019-06-20'),
            ],
        ];
    }
}
