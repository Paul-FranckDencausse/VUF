<?php 
// src/Controller/DashboardController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        // Vous pouvez passer ici des données dynamiques à votre template
        return $this->render('dashboard/index.html.twig', [
            'numberOfUsers' => 150,
            'revenue' => 5000,
            'tasks' => 75
        ]);
    }
}
