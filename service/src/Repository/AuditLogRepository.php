<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\AuditLog;
use App\Model\AuditLog\AuditLogQuery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AuditLog>
 *
 * @method AuditLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuditLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<AuditLog> findAll()
 * @method array<AuditLog> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuditLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuditLog::class);
    }

    public function findDeletedForEntityQb(string $entityFqcn): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->where('a.entityFqcn = :entityFqcn')
            ->setParameter('entityFqcn', $entityFqcn)
            ->andWhere('a.action = :action')
            ->setParameter('action', 'delete');
    }

    public function findForQueryQb(AuditLogQuery $query): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->where('a.entityFqcn = :entityFqcn')
            ->setParameter('entityFqcn', $query->getFqcn())
            ->andWhere('a.entityId = :entityId')
            ->setParameter('entityId', $query->getId());
    }

    public function add(AuditLog $entity, bool $flush = true): void
    {
        $this->getEntityManager()->persist($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AuditLog $entity, bool $flush = true): void
    {
        $this->getEntityManager()->remove($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
