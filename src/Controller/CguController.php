<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Définit la classe CguController qui étend la classe AbstractController de Symfony
class CguController extends AbstractController
{
    // Définit une route pour l'URL "/legal" avec le nom "app_legal"
    #[Route('/legal', name: 'app_legal')]
    public function index(): Response
    {
        // Retourne une réponse HTTP avec le contenu du fichier "legal/index.html.twig"
        return $this->render('legal/index.html.twig', [
            'controller_name' => 'LegalController',
        ]);
    }

    // Définit une route pour l'URL "/cgu" avec le nom "app_cgu"
    #[Route('/cgu', name: 'app_cgu')]
    public function indexCgv(): Response
    {
        // Retourne une réponse HTTP avec le contenu du fichier "cgu/index.html.twig"
        return $this->render('cgu/index.html.twig', [
            'controller_name' => 'CguController',
        ]);
    }

    // Définit une route pour l'URL "/cgv" avec le nom "app_cgv"
    #[Route('/cgv', name: 'app_cgv')]
    public function indexCgu(): Response
    {
        // Retourne une réponse HTTP avec le contenu du fichier "cgv/index.html.twig"
        return $this->render('cgv/index.html.twig', [
            'controller_name' => 'CgvController',
        ]);
    }

    // Définit une route pour l'URL "/rgpd" avec le nom "app_rgpd"
    #[Route('/rgpd', name: 'app_rgpd')]
    public function indexRgpd(): Response
    {
        return $this->render('rgpd/index.html.twig', [
            'controller_name' => 'RgpdController',
        ]);
    }
}
