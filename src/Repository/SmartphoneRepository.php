<?php

namespace App\Repository;

use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\Ram;
use App\Entity\Smartphone;
use App\Entity\Status;
use App\Entity\Stockage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Smartphone>
 *
 * @method Smartphone|null find($id, $lockMode = null, $lockVersion = null)
 * @method Smartphone|null findOneBy(array $criteria, array $orderBy = null)
 * @method Smartphone[]    findAll()
 * @method Smartphone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmartphoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Smartphone::class);
    }

    public function save(Smartphone $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Smartphone $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function queryFindAll(): Query
    {
        return $this->createQueryBuilder('s')->getQuery();
    }

    public function findForPagination(
        ?Brand $brand = null,
        ?Stockage $stockage = null,
        ?Status $status = null,
        ?Ram $ram = null,
        ?Model $model = null,
        ?string $search = null
    ): Query {
        $query = $this->createQueryBuilder('s')
            ->orderBy('s.id', 'ASC');
        if ($brand) {
            $query->leftJoin('s.brand', 'b')
                ->andWhere('b.id = :brandId')
                ->setParameter('brandId', $brand->getId());
        }
        if ($stockage) {
            $query->leftJoin('s.stockage', 'st')
                ->andWhere('st.id = :stockageId')
                ->setParameter('stockageId', $stockage->getId());
        }
        if ($status) {
            $query->leftJoin('s.status', 'sta')
                ->andWhere('sta.id = :statusId')
                ->setParameter('statusId', $status->getId());
        }
        if ($ram) {
            $query->leftJoin('s.ram', 'r')
                ->andWhere('r.id = :ramId')
                ->setParameter('ramId', $ram->getId());
        }
        if ($model) {
            $query->leftJoin('s.model', 'm')
                ->andWhere('m.id = :modelId')
                ->setParameter('modelId', $model->getId());
        }
        if ($search) {
            $query->join('s.brand', 'b')
                ->join('s.model', 'm')
                ->andWhere('b.name LIKE :search')
                ->orWhere('m.name LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }
        return $query->getQuery();
    }

//    /**
//     * @return Smartphone[] Returns an array of Smartphone objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Smartphone
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
