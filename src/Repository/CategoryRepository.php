<?php

namespace App\Repository;

use App\Entity\Category;
use App\Service\MySlugger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    private $mySlugger;

    public function __construct(ManagerRegistry $registry, MySlugger $mySlugger)
    {
        $this->mySlugger = $mySlugger;
        parent::__construct($registry, Category::class);
    }

    public function add(Category $entity, bool $flush = false): void
    {
        $entity->setSlug($this->mySlugger->slugify($entity->getName()));
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    // public function getWomenProducts(Category $category) {
// 
    //     $conn = $this->getEntityManager()->getConnection();
// 
    //     $products = $category->getProducts();
// 
    //     dd($products);
// 
    //     $sql = "SELECT * FROM ' . $products . '
    //     WHERE gender = 'Woman";
// 
    //     $stmt = $conn->prepare($sql);
    //     $resultSet = $stmt->executeQuery();
// 
    //     return $resultSet->fetchAllAssociative();
// 
    // }

//    /**
//     * @return Category[] Returns an array of Category objects
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

//    public function findOneBySomeField($value): ?Category
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
