<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VinylController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response {
        
        return new Response('Page One');
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
