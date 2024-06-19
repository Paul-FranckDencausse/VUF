<?php
// src/Controller/ContactController.php

namespace App\Controller;
// Définit l'espace de nommage du contrôleur.

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
// Importe les classes nécessaires au fonctionnement du contrôleur.

#[Route('/contact')]
class ContactController extends AbstractController
// Définit la classe ContactController qui hérite de la classe AbstractController de Symfony.
{
    public function __construct(private EntityManagerInterface $entityManager)
    // Définit un constructeur pour injecter l'EntityManagerInterface, qui est utilisé pour interagir avec la base de données.
    {
    }

    #[Route('/', name: 'contact', methods:["GET","POST"])]
    // Définit une annotation de route pour la méthode index(). Cette route correspond à l'URL '/contact' et a un nom de route 'contact'.
    public function index(Request $request): Response
    // Définit la méthode index() qui gère les requêtes pour la page de contact. Elle prend en paramètre une instance de Request et retourne une instance de Response.
    {
        $contact = new Contact();
        // Crée une nouvelle instance de l'entité Contact.

        $form = $this->createForm(ContactType::class, $contact);
        // Crée un formulaire à partir du formulaire ContactType et lie ce formulaire à l'instance de Contact.

        $form->handleRequest($request);
        // Traite la requête et remplit le formulaire avec les données soumises.

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setUser($this->getUser());
        // Vérifie si le formulaire a été soumis et si les données soumises sont valides.
            // Enregistrer le contact dans la base de données, envoyer un e-mail, etc.
            $this->entityManager->persist($contact);
            $this->entityManager->flush();
            // Enregistre le contact dans la base de données.

            // Redirection vers une page de confirmation
            return $this->redirectToRoute('contact_confirmation');
            // Redirige vers la route 'contact_confirmation'.
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
        // Retourne une réponse HTTP contenant le rendu du template 'contact/index.html.twig' avec la vue du formulaire.
    }

    #[Route('/confirmation', name: 'contact_confirmation')]
    // Définit une annotation de route pour la méthode confirmation(). Cette route correspond à l'URL '/contact/confirmation' et a un nom de route 'contact_confirmation'.
    public function confirmation(): Response
    // Définit la méthode confirmation() qui gère les requêtes pour la page de confirmation et retourne une réponse HTTP contenant le rendu du template 'contact/confirmation.html.twig'.
    {
        return $this->render('contact/confirmation.html.twig');
    }
}