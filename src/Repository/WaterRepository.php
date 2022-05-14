<?php

namespace App\Repository;

use App\Entity\Water;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Water>
 *
 * @method Water|null find($id, $lockMode = null, $lockVersion = null)
 * @method Water|null findOneBy(array $criteria, array $orderBy = null)
 * @method Water[]    findAll()
 * @method Water[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WaterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Water::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Water $entity, bool $flush = true): void
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
    public function remove(Water $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    public function findRecordWater()
//    {
//        return $this->createQueryBuilder('water')
//            ->addOrderBy('water.vangsten')
//            ->leftJoin('vangsten.water', 'vangsten')
//            ->select('SUM(water.vangsten) as vangstenWater')
//            ->getQuery()
//            ->getOneOrNullResult()
//            ;
//    }

    public function search($term)
    {
        return $this->createQueryBuilder('water')
            ->andWhere('water.name LIKE :searchTerm 
                OR water.aantekeningen LIKE :searchTerm
                OR water.type LIKE :searchTerm
                OR water.hotspots LIKE :searchTerm
                ')
            ->addSelect('water')
            ->setParameter('searchTerm', '%'.$term.'%')
            ->getQuery()
            ->execute()
            ;
    }
}
