<?php

namespace App\Repository;

use App\Entity\CookingTools;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CookingTools|null find($id, $lockMode = null, $lockVersion = null)
 * @method CookingTools|null findOneBy(array $criteria, array $orderBy = null)
 * @method CookingTools[]    findAll()
 * @method CookingTools[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CookingToolsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CookingTools::class);
    }

    // /**
    //  * @return CookingTools[] Returns an array of CookingTools objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CookingTools
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
