<?php

namespace App\Repository;

use App\Entity\AvisTypesCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AvisTypesCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvisTypesCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvisTypesCategories[]    findAll()
 * @method AvisTypesCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisTypesCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvisTypesCategories::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(AvisTypesCategories $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(AvisTypesCategories $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return AvisTypesCategories[] Returns an array of AvisTypesCategories objects
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
    public function findOneBySomeField($value): ?AvisTypesCategories
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
