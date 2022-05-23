<?php

namespace App\Repository;

use App\Entity\Vangst;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Vangst>
 *
 * @method Vangst|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vangst|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vangst[]    findAll()
 * @method Vangst[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VangstRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vangst::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Vangst $entity, bool $flush = true): void
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
    public function remove(Vangst $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Vangst[] Returns an array of Vangst objects
     */

    public function findAllFish()
    {
        return $this->createQueryBuilder('fish')
            ->leftJoin('fish.water', 'water')
            ->addSelect('water')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findRecordFish()
    {
        return $this->createQueryBuilder('fish')
            ->orderBy('fish.gewicht', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findSmallestFish()
    {
        return $this->createQueryBuilder('fish')
            ->orderBy('fish.gewicht', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    public function orderByWeight()
    {
        return $this->createQueryBuilder('fish')
            ->addOrderBy('fish.gewicht', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function search($term)
    {
        return $this->createQueryBuilder('fish')
            ->andWhere('fish.aantekeningen LIKE :searchTerm 
                OR fish.gewicht LIKE :searchTerm
                OR water.name LIKE :searchTerm 
                OR fish.rig LIKE :searchTerm')
            ->leftJoin('fish.water', 'water')
            ->addSelect('water')
            ->setParameter('searchTerm', '%'.$term.'%')
            ->getQuery()
            ->execute()
            ;
    }

    public function orderByKind($kind)
    {
        return $this->createQueryBuilder('fish')
            ->leftJoin('fish.soort', 'soort')
            ->addSelect('soort.name')
            ->andWhere('soort.name = :searchTerm')
            ->setParameter('searchTerm', $kind)
            ->getQuery()
            ->getResult()
            ;
    }

    public function orderByCaughtMonth($month)
    {
        return $this->createQueryBuilder('fish')
            ->andWhere('MONTH(fish.datum) = :month')
            ->setParameter(':month', $month)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findWithWaterJoin($id)
    {
        return $this->createQueryBuilder('fish')
            ->andWhere('fish.id = :id')
            ->leftJoin('fish.water', 'water')
            ->addSelect('water')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

}
