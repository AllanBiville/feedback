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
        // $stmt->setParameter(":value", $value, PDO::PARAM_INT);
        // $stmt->setParameter(":type", $type, PDO::PARAM_STR);
        // $stmt->setParameter(":date_repas_start", $startDate, PDO::PARAM_STR);
        // $stmt->setParameter(":date_repas_end", $endDate, PDO::PARAM_STR);
        
        $resultSet = $stmt->executeQuery(['value' => $value,
                                         'type' => $type,
                                         'date_repas_start' => $startDate,
                                         'date_repas_end' => $endDate]);
        // $resultSet = $stmt->executeQuery(['type' => $type]);
        // $resultSet = $stmt->executeQuery(['date_repas_start' => $startDate]);
        // $resultSet = $stmt->executeQuery(['date_repas_end' => $endDate]);
// A REPARER RESULTSET
        return $resultSet->fetchAllAssociative();


        // $query = $entityManager->createQuery(
        //     'SELECT avis.date , avis_types_categories.note, types_categories.shortname
        //      FROM App\Entity\avis, avis_types_categories, types_categories 
        //      WHERE avis.id = avis_types_categories.avis_id
        //      AND avis_types_categories.types_categories_id = types_categories.id
        //      AND avis_types_categories.note = :value
        //      AND types_categories.shortname = :type
        //      AND avis.date > = :date_repas_start AND avis.date < = :date_repas_end');
             
            // SELECT r.date_repas, a.gout, a.diversite, a.chaleur, a.disponibilite, a.proprete, a.acceuil, a.commentaire, count(a.gout)
            // FROM App\Entity\Avis a
            // INNER JOIN a.repas r
            // WHERE r.date_repas > = :date_repas_start AND r.date_repas < = :date_repas_end AND a.gout = :value

        // $query->setParameter('value', $value);
        // $query->setParameter('type', $type);
        // $query->setParameter('date_repas_start', $startDate);
        // $query->setParameter('date_repas_end', $endDate);


        // returns an array of Product objects
        // return $query->getOneOrNullResult();   
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
