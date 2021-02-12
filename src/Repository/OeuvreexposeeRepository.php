<?php

namespace App\Repository;

use App\Entity\Oeuvreexposee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Oeuvreexposee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Oeuvreexposee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Oeuvreexposee[]    findAll()
 * @method Oeuvreexposee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OeuvreexposeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oeuvreexposee::class);
    }

    // /**
    //  * @return Oeuvreexposee[] Returns an array of Oeuvreexposee objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Oeuvreexposee
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function jointure($value)
    {
        $conn = $this->getEntityManager();
        $sql=$conn->createQuery('
            SELECT o FROM App\Entity\OeuvreExposee oe
            INNER JOIN App\Entity\Oeuvre o WITH o.id = oe.id_oeuvre
            INNER JOIN App\Entity\Exposition e WITH e.id = oe.id_exposition
            WHERE e.id ='.$value
        );
        return $sql->getResult();
    }
}
