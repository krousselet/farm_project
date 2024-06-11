<?php

namespace App\Repository;

use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Animal>
 */
class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    /**
     * @param string $speciesName
     * @return Animal[]
     */
    public function findBySpeciesOrderedByCreatedAtDesc(string $speciesName)
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.espece', 's')
            ->where('s.name = :speciesName')
            ->setParameter('speciesName', $speciesName)
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function countAnimalsBySpecies()
    {
        $qb = $this->createQueryBuilder('a')
            ->select('s.name, COUNT(a.id) as count')
            ->join('a.espece', 's')
            ->groupBy('s.name');

        return $qb->getQuery()->getResult();
    }

    //    /**
    //     * @return Animal[] Returns an array of Animal objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Animal
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
