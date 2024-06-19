<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            
        ]);
    }

    #[Route('/list', name: 'contact_list')]
    public function listContacts(Request $request, EntityManagerInterface $entityManager, ContactRepository $contactRepository): Response
    {
        //$sort = $request->query->get('sort', 'name'); // Par défaut, trier par nom
        //$direction = $request->query->get('direction', 'ASC'); // Direction par défaut
    
        //$contacts = $entityManager->getRepository(Contact::class)->findAllSorted($sort, $direction);
        //$contacts = $contactRepository->findAllSorted($sort, $direction);
        

        $contacts = $contactRepository->findByDates();
        
        return $this->render('contact/list.html.twig', [
            'contacts' => $contacts
        ]);
    }

    #[Route('/view/{id}', name: 'contact_view')]
    public function view(int $id, ContactRepository $contactRepository,Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = $contactRepository->find($id);

        $comments = $contact->getComments();

        if (!$contact) {
            throw $this->createNotFoundException('Le contact demandé n\'existe pas');
        }

        $user = $this->getUser();
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($user);
            $comment->setContact($contact);

            $entityManager->persist($comment);
            $entityManager->flush();
            
        }

        return $this->render('contact/view.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
            'comments' => $comments,
        ]);
    }
}
