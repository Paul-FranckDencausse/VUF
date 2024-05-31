<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ErrorHandlerController extends AbstractController
{
    #[Route('/404', name:"app_404")]
    public function show404(): Response
    {
        // Render your custom 404 error page
        return $this->render('error404.html.twig');
    }
}
