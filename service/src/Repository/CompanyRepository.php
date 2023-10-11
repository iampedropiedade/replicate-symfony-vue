<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Company>
 *
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<Company> findAll()
 * @method array<Company> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    /**
     * @param array<string, mixed>|null $filters
     */
    public function findForListingQb(?array $filters = null): QueryBuilder
    {
        $qb = $this->createQueryBuilder('c')->orderBy('c.createdAt', 'desc');
        if ($filters === null) {
            return $qb;
        }
        if ($filters['query']) {
            $qb->andWhere('c.name LIKE :query')
                ->setParameter('query', '%' . $filters['query'] . '%');
        }
        if ($filters['businessCategory']) {
            $qb->andWhere('c.businessCategory = :businessCategory')
                ->setParameter('businessCategory', $filters['businessCategory']);
        }
        return $qb;
    }

    public function add(Company $entity, bool $flush = true): void
    {
        $this->getEntityManager()->persist($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Company $entity, bool $flush = true): void
    {
        $this->getEntityManager()->remove($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
