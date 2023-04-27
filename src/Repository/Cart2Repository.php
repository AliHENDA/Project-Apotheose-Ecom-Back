<?php

namespace App\Repository;

use App\Entity\Cart2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart2>
 *
 * @method Cart2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart2[]    findAll()
 * @method Cart2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Cart2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart2::class);
    }

    public function add(Cart2 $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cart2 $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getExistingCart()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql= "SELECT * FROM cart2 WHERE `status` = false";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
       // dd($resultSet);

        return $resultSet->fetchAllAssociative();
        
    }

//    /**
//     * @return Cart2[] Returns an array of Cart2 objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cart2
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
