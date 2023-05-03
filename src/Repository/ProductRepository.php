<?php

namespace App\Repository;

use App\Entity\Product;
use App\Service\MySlugger;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    private $mySlugger;

    public function __construct(ManagerRegistry $registry, MySlugger $mySlugger)
    {
        $this->mySlugger = $mySlugger;
        parent::__construct($registry, Product::class);
    }

    public function add(Product $entity, bool $flush = false): void
    {
        $entity->setSlug($this->mySlugger->slugify($entity->getName()));

        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByProductName() {

        $conn = $this->getEntityManager()->getConnection();

        $sql= "SELECT  DISTINCT `name`, `description`, `picture`, `color`, `rate`, `price`,  `best_sellers_order`, `slug`, `category_id`, `created_at`, `updated_at`
        FROM product";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }

    public function findMenProducts() {

        $conn = $this->getEntityManager()->getConnection();

        $sql= "SELECT *
        FROM product
        WHERE gender = 'Man' AND gender = 'Unisex'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }

    public function findWomenProducts() {

        $conn = $this->getEntityManager()->getConnection();

        $sql= "SELECT *
        FROM product
        WHERE gender = 'Woman' AND gender = 'Unisex'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
