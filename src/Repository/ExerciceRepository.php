<?php

namespace App\Repository;

use App\Entity\Exercice;
use App\Entity\Level;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Exercice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercice[]    findAll()
 * @method Exercice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Exercice::class);
    }

    public function findByNumber($number, $level){

        return $this->createQueryBuilder('e')
            ->innerJoin('e.level', 'l')
            ->andWhere('e.number = :number')
            ->setParameter('number', $number)
            ->andWhere('l.number = :level')
            ->setParameter('level', $level)
            ->getQuery()
            ->getOneOrNullResult();
    }


    // /**
    //  * @return Exercice[] Returns an array of Exercice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exercice
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function lookForExercice($valeur)
    {

        return $this->createQueryBuilder('e')
            ->andWhere($this->createQueryBuilder('e')->expr()->orX(
                $this->createQueryBuilder('e')->expr()->like('e.libelle',
                    $this->createQueryBuilder('e')->expr()->literal('%'.$valeur.'%'))
            ))
            ->orderBy('e.libelle', 'ASC')
            ->getQuery()
            ->getResult();

    }
}
