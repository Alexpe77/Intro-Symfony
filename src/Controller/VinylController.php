<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VinylController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response {
        
        $tracks = [
            ['song' => 'No Gods, No Masters', 'artist' => 'Machine Head'],
            ['song' => 'Pisces','artist' => 'Jinjer'],
            ['song' => 'Around The Fur','artist' => 'Deftones'],
            ['song' => 'Rose Tattoo','artist' => 'Dropkick Murphys'],
            ['song' => 'Here Comes The Boom','artist' => 'Rise Of The Northstar'],
        ];

        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'Favourite Mix',
            'tracks' => $tracks,
        ]);
    }

    #[Route('/browse/{genre}')]
    public function browse(string $genre = null): Response {
        
        if($genre){
            $title = 'Genre: ' . str_replace('-', ' ', $genre);
        } else {
            $title = 'All genres';
        }
        
        return new Response($title);
    }
}
