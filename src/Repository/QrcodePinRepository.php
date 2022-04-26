<?php

namespace App\Repository;

use App\Entity\QrcodePin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QrcodePin|null find($id, $lockMode = null, $lockVersion = null)
 * @method QrcodePin|null findOneBy(array $criteria, array $orderBy = null)
 * @method QrcodePin[]    findAll()
 * @method QrcodePin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QrcodePinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QrcodePin::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(QrcodePin $entity, bool $flush = true): void
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
    public function remove(QrcodePin $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    public function searchPin()
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    // /**
    //  * @return QrcodePin[] Returns an array of QrcodePin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QrcodePin
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
