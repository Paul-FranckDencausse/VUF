<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;
use App\Form\ContactType;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        // Définition des variables nécessaires pour la vue
        $location = 'Bordeaux';
        $phone = '0643538715';
        $email = 'dencaussepaulfranck@hotmail.com';

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'location' => $location,
            'phone' => $phone,
            'email' => $email,
        ]);
    }

    #[Route('/contact/new', name: 'contact_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Your contact request has been sent.');
            return $this->redirectToRoute('app_contact');  // Corrigé pour pointer vers la route 'app_contact'.
        }

        return $this->render('contact/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
