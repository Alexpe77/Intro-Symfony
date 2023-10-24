<?php

namespace App\Repository;

use App\Entity\Vinyl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vinyl>
 *
 * @method Vinyl|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vinyl|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vinyl[]    findAll()
 * @method Vinyl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VinylRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vinyl::class);
    }

   /**
    * @return Vinyl[] Returns an array of Vinyl objects
    */
   public function findAllOrderedByVotes(string $genre = null): array
   {
        $queryBuilder = $this->createQueryBuilder('mix')
       ->orderBy('mix.votes', 'DESC');

       if ($genre) {
        $queryBuilder->andWhere('mix.genre = :genre')
        ->setParameter('genre', $genre);
       }

       return $queryBuilder
       ->getQuery()
       ->getResult();
   }

//    public function findOneBySomeField($value): ?Vinyl
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
