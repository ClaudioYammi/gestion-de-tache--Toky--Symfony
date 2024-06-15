<?php

namespace App\Repository;

use App\Entity\ListeTache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListeTache>
 *
 * @method ListeTache|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeTache|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeTache[]    findAll()
 * @method ListeTache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeTacheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeTache::class);
    }

    public function add(ListeTache $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ListeTache $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
    * @return void Returns an array of Employer objects
    */
    public function countListeTache(){
        $query = $this->createQueryBuilder('query')
        ->select('query.nom_tache as nombre, count(query) as counte')
       ;
        return $query->getQuery()->getResult();
    }

//    /**
//     * @return ListeTache[] Returns an array of ListeTache objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ListeTache
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
