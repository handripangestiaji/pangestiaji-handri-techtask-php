<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Contract\RecipeRepositoryInterface;
use Doctrine\ORM\Query;
/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository implements RecipeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function add(array $data)
    {
        $recipe = new Recipe();

        $recipe->setTitle($data['title']);

        return $recipe;
    }

    public function findAllInArray(): array 
    {
        $query = $this->createQueryBuilder('r')
            ->leftJoin('r.ingredients', 'i')
            ->addSelect('i')
            ->getQuery();

        return $query->getResult(Query::HYDRATE_ARRAY);
    }

    public function findAllGreaterThanUseBy($useBy, array $orderBy = null): array
    {
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();

        // Subquery for inside NOT IN 
        $qb->select('rc.id')
            ->from('App\Entity\Recipe', 'rc')
            ->leftJoin('rc.ingredients', 'ing')
            ->where('ing.use_by < :useBy');

        // Query
        $query = $this->createQueryBuilder('r')
            ->leftJoin('r.ingredients', 'i')
            ->addSelect('i')
            ->where($qb->expr()->notIn(
                'r.id', $qb->getDQL()
            ))
            ->orderBy('i.best_before', 'DESC')
            ->setParameter('useBy', $useBy)
            ->getQuery();

        return $query->getResult(Query::HYDRATE_ARRAY);
    }

    // /**
    //  * @return Recipe[] Returns an array of Recipe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recipe
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
