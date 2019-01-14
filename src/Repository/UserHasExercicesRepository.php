<?php

namespace App\Repository;

use App\Entity\Exercice;
use App\Entity\User;
use App\Entity\UserHasExercices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserHasExercices|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserHasExercices|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserHasExercices[]    findAll()
 * @method UserHasExercices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserHasExercicesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserHasExercices::class);
    }

    public function getSave(User $user, Exercice $exercice)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.users = :user')
            ->setParameter('user', $user)
            ->andWhere('u.exercices = :exercice')
            ->setParameter('exercice', $exercice)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getLastSave(User $user, Array $levels)
    {
        $lastSaves = [];

        foreach ($levels as $level) {

            $save = $this->createQueryBuilder('u')
                ->innerJoin('u.exercices', 'e')
                ->select('MAX(e.number)')
                ->andWhere('e.level = :level')
                ->andWhere('u.finish = true')
                ->setParameter('level', $level)
                ->getQuery()
                ->getOneOrNullResult();

            $lastSaves[$level->getNumber()]=$save;
        }

        return $lastSaves;
    }

    // /**
    //  * @return UserHasExercices[] Returns an array of UserHasExercices objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserHasExercices
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
