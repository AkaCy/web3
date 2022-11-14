<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @extends ServiceEntityRepository<Evenement>
 *
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    public function save(Evenement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Evenement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function myFindAll(){
//création du queryBuilder paramétré avec l'alias de l'entité événement
        $queryBuilder=$this->createQueryBuilder('e');
//récupération de la query à partir du queryBuilder
        $query=$queryBuilder->getQuery();
//récupération du résultat à partir de la query
        $results=$query->getResult();
//on retourne les résultats
        return $results;
    }
    public function find2021(){
//création du queryBuilder paramétré avec l'alias de l'entité événement
        $queryBuilder=$this->createQueryBuilder('e');
//récupération de la query à partir du queryBuilder
        $query=$queryBuilder->where('e.date_heure_debut between :start and :end')
            -> setParameter('start',new \DateTime('2021-01-01 00:00:00'))
            ->setParameter('end',new \DateTime('2021-12-31 23:59:00'))
            ->getQuery();
//récupération du résultat à partir de la query
        $results=$query->getResult();
//on retourne les résultats
        return $results;
    }

//    /**
//     * @return Evenement[] Returns an array of Evenement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Evenement
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
