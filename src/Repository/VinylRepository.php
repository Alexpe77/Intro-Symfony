<?php

namespace App\Repository;

use App\Entity\Vinyl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

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
        $queryBuilder = $this->addOrderByVotesQueryBuilder();

       if ($genre) {
        $queryBuilder->andWhere('mix.genre = :genre')
        ->setParameter('genre', $genre);
       }

       return $queryBuilder
       ->getQuery()
       ->getResult();
   }

   private function addOrderByVotesQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder {

    $queryBuilder = $queryBuilder ?? $this->createQueryBuilder('mix');

    return $queryBuilder->orderBy('mix.votes', 'DESC');
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
