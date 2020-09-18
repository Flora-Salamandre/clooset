<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
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
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByFilters($category, $maxPrice, $search, $color) 
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager;

        $queryString = 'SELECT a
            FROM App\Entity\Article a';

        if ($category != null) {
            $queryString = $queryString 
                . ' WHERE a.category = :category';
        }
        if ($search != null) {
            if ($category != null) {
                $word = ' AND';
            } else {
                $word = ' WHERE';
            }
            $queryString = $queryString
                . $word 
                . ' (a.name LIKE :search'
                . ' OR a.brand LIKE :search'
                . ' OR a.description LIKE :search)';
        }
        if ($maxPrice != null) {
            if ($category != null || $search != null) {
                $word = ' AND';
            } else {
                $word = ' WHERE';
            }
            $queryString = $queryString 
                . $word 
                . ' a.price <= :maxPrice';
        }
        if ($color != null) {
            if ($category != null || $search != null || $maxPrice != null) {
                $word = ' AND';
            } else {
                $word = ' WHERE';
            }
            $queryString = $queryString 
                . $word
                . ' (a.color1 = :color'
                . ' OR a.color2 = :color)';
        }

        $query = $query->createQuery($queryString);
        
        if ($category != null) {
            $query = $query->setParameter('category', $category);
        }
        if ($search != null) {
            $query = $query->setParameter('search', '%' . $search . '%');
        }
        if ($maxPrice != null) {
            $query = $query->setParameter('maxPrice', $maxPrice);
        }
        if ($color != null) {
            $query = $query->setParameter('color', $color);
        }
        
        return $query->getResult();
    }
}
