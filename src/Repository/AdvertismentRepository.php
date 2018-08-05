<?php

namespace App\Repository;

use App\Entity\Advertisment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Advertisment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advertisment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advertisment[]    findAll()
 * @method Advertisment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertismentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Advertisment::class);
    }

//    /**
//     * @return Advertisment[] Returns an array of Advertisment objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Advertisment
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
