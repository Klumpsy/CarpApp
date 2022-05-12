<?php

namespace App\Repository;

use App\Entity\Vangst;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
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

    public function findRecordFish()
    {
        return $this->createQueryBuilder('v')
            ->orderBy('v.gewicht', 'DESC')
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
                OR water.name LIKE :searchTerm')
            ->leftJoin('fish.water', 'water')
            ->addSelect('water')
            ->setParameter('searchTerm', '%'.$term.'%')
            ->getQuery()
            ->execute()
            ;
    }
}
