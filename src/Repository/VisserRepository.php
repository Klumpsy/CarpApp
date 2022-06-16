<?php

namespace App\Repository;

use App\Entity\Visser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Symfony\Component\DependencyInjection\Loader\Configurator\expr;

/**
 * @extends ServiceEntityRepository<Visser>
 *
 * @method Visser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visser[]    findAll()
 * @method Visser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visser::class);
    }

    public function add(Visser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Visser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findWithVangstenJoin($id)
    {
        return $this->createQueryBuilder('fisherman')
            ->andWhere('fisherman.id = :id')
            ->leftJoin('fisherman.vangsten', 'vangsten')
            ->addSelect('vangsten')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }



//    /**
//     * @return Visser[] Returns an array of Visser objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Visser
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
