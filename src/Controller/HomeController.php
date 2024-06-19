<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Définition de la classe HomeController qui étend la classe AbstractController
class HomeController extends AbstractController
{
    // Définition de la route pour la page d'accueil avec le nom "app_home"
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // Définition des données pour la localisation, le téléphone et l'email
        $location = 'Bordeaux'; // Exemple de localisation
        $phone = '06 00 00 00 00 '; // Exemple de numéro de téléphone
        $email = 'contact@virtualurbanflow.com'; // Exemple d'email

        // Envoi de toutes les variables au template en une seule fois
        return $this->render('home/index.html.twig', [
            'location' => $location,
            'phone' => $phone,
            'email' => $email
        ]);
    }

    // Définition de la route pour la page de l'équipe avec le nom "app_team"
    #[Route('/team', name: 'app_team')]
    public function showTeam(): Response
    {
        return $this->render('team/index.html.twig', [
            'controller_name' => 'TeamController',
        ]);
    }

    // Définition de la route pour la page des défilés avec le nom "app_catwalks"
    #[Route('/catwalks', name: 'app_catwalks')]
    public function catWalk(): Response
    {
        return $this->render('catwalks/index.html.twig', [
            'controller_name' => 'CatwalksController',
        ]);
    }

    // Définition de la route pour la page des services avec le nom "app_services"
    #[Route('/services', name: 'app_services')]
    public function services(): Response
    {
        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }

    #[Route('/404', name:"app_404")]
    public function show404(): Response
    {
        // en cas d'erreur 
        return $this->render('error404.html.twig');
    }
}
