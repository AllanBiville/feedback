<?php

namespace App\Repository;

use PDO;
use App\Entity\Avis;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Avis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Avis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Avis[]    findAll()
 * @method Avis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Avis::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Avis $entity, bool $flush = true): void
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
    public function remove(Avis $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAllCommentary()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT a.date,a.commentary, t.name FROM avis a,types_users t
            where a.users_id = t.id
            order by a.date ASC

            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
    public function TauxDeVote($value)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT t.id, t.name, count(t.name) as count FROM avis a,types_users t
            where a.users_id = t.id
            AND t.id = :value
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['value' => $value]);
        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
    public function countData($value, $type, $startDate=null, $endDate=null)
    {
        
        if (!isset($startDate)) {
            $startDate = date('Y-m-d');
        }
        if (!isset($endDate)) {
            $endDate = date('Y-m-d');
        }
                
        $entityManager = $this->getEntityManager()->getConnection();
        
        $sql = '
            SELECT count(*) as count
            FROM avis a, avis_types_categories, types_categories
            WHERE a.id = avis_types_categories.avis_id
            AND avis_types_categories.types_categories_id = types_categories.id
            AND avis_types_categories.note = :value
            AND types_categories.shortname = :type
            AND a.date >= :date_repas_start AND a.date <= :date_repas_end
        ';

        $stmt = $entityManager->prepare($sql);

        $resultSet = $stmt->executeQuery(['value' => $value,
                                         'type' => $type,
                                         'date_repas_start' => $startDate,
                                         'date_repas_end' => $endDate]);

        return $resultSet->fetchAllAssociative();
 
    }

    // /**
    //  * @return Avis[] Returns an array of Avis objects
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
    public function findOneBySomeField($value): ?Avis
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
