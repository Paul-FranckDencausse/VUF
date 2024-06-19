<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }
    // src/Repository/ContactRepository.php

public function findAllSorted($sortField = 'name', $direction = 'ASC')
{
    return $this->createQueryBuilder('c')
        ->orderBy('c.' . $sortField, $direction)
        ->getQuery()
        ->getResult();
}

public function findByDates()
{
    return $this->createQueryBuilder('c') // 'c' est l'alias de l'entité Contact
        ->innerJoin('c.User', 'u') // Jointure avec l'entité User où 'user' est la propriété dans Contact qui fait référence à User
        ->addSelect('u.name, u.email, c.desiredDates, c.id') // Sélectionner les champs nécessaires
        ->orderBy('c.id','DESC')
        ->getQuery() // Obtenir la requête
        ->getResult(); // Exécuter la requête et obtenir le résultat
}




}
