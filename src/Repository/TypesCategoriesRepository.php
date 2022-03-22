<?php

namespace App\Repository;

use App\Entity\TypesCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypesCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypesCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypesCategories[]    findAll()
 * @method TypesCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypesCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypesCategories::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(TypesCategories $entity, bool $flush = true): void
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
    public function remove(TypesCategories $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAllActive()
    {
        $qb = $this->createQueryBuilder('t');
        $qb->andWhere('t.statut = :val');
        $qb->setParameter('val', 1);
            $qb->orderBy('t.id', 'ASC');

        return $qb->getQuery()->getResult();
    }
    public function findAll()
    {
        $qb = $this->createQueryBuilder('t');
        $qb->orderBy('t.statut', 'DESC');
        return $qb->getQuery()->getResult();
    }


    // /**
    //  * @return TypesCategories[] Returns an array of TypesCategories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypesCategories
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
