<?php
// src/Controller/UserController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Repository\UserRepository;
//seulement pour les administrateurs
#[Route('/admin')]
class UsersController extends AbstractController
{
// affiche tous les users
    #[Route('/users', name: 'app_users')]
    public function userList(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('users/list.html.twig', [
            'users' => $users
        ]);
    }

   
//affiche un user
#[Route('/users/{id}', name: 'user_profile')]
public function userProfile(EntityManagerInterface $em, int $id): Response
{
    $user = $em->getRepository(User::class)->find($id);

    if (!$user) {
        throw $this->createNotFoundException('No user found for id ' . $id);
    }

    // Assuming you have a form or some method to handle role changes
    // You might handle it here or in another method

    return $this->render('users/profile.html.twig', [
        'user' => $user
    ]);
}
//affiche le rôle d'un user
#[Route('/user/role/{id}', name: 'app_user_role', methods:['GET'])]
public function userRole($id, UserRepository $userRepository, EntityManagerInterface $em)
{
    //je récupère l'instance du user à update
    $user = $userRepository->findOneBy(['id' => $id]);
    //je récupère son tableau de rôle grace à la methode get user de mon entity user
    $userRole = $user->getRoles();
    //grâce à la méthode in_array je vérifie si le rôle admin est présent dans le tableau du champ rôle
    if(in_array('ROLE_ADMIN', $userRole, true)) {
        //grâce à la méthode arraydiff de php je supprime le rôle admin
        $updatedRole[] = 'ROLE_USER'; 

    }else{
        $updatedRole[] = 'ROLE_ADMIN'; 
    }

    $user->setRoles($updatedRole);
    $em->persist($user);
    $em->flush();
    
    return $this->redirectToRoute('app_users');
}

}



