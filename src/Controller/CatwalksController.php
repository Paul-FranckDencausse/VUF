<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatwalksController extends AbstractController
{
    #[Route('/catwalks', name: 'app_catwalks')]
    public function index(): Response
    {
        return $this->render('catwalks/index.html.twig', [
            'controller_name' => 'CatwalksController',
        ]);
    }
}
