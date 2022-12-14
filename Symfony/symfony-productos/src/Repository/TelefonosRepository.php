<?php

namespace App\Repository;

use App\Entity\Telefonos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Telefonos>
 *
 * @method Telefonos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Telefonos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Telefonos[]    findAll()
 * @method Telefonos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelefonosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Telefonos::class);
    }

    public function save(Telefonos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Telefonos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByMarca($marca): array
    {
        $qb = $this->createQueryBuilder('c')
        ->andWhere('c.Marca LIKE :marca')
        ->setParameter('marca', '%'. $marca . '%')
        ->getQuery();

        return $qb->execute();
    }

//    /**
//     * @return Telefonos[] Returns an array of Telefonos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Telefonos
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
