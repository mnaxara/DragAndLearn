<?php

namespace App\Repository;

use App\Entity\Exercice;
use App\Entity\Level;
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
        $level = $exercice->getLevel();
        $levelNumber = $level->getNumber();

        return $this->createQueryBuilder('u')
            ->innerJoin('u.exercices', 'e')
            ->andWhere('u.users = :user')
            ->setParameter('user', $user)
            ->andWhere('e.level = :level')
            ->setParameter('level', $level)
            ->andWhere('u.exercices = :exercice')
            ->setParameter('exercice', $exercice)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getFinishSave(User $user, Exercice $exercice)
    {
        $level = $exercice->getLevel();
        $levelNumber = $level->getNumber();

        return $this->createQueryBuilder('u')
            ->innerJoin('u.exercices', 'e')
            ->andWhere('u.users = :user')
            ->setParameter('user', $user)
            ->andWhere('e.level = :level')
            ->setParameter('level', $level)
            ->andWhere('u.exercices = :exercice')
            ->setParameter('exercice', $exercice)
            ->andWhere('u.finish = true')
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getLastSaves(User $user, Array $levels)
    {
        $lastSaves = [];

        foreach ($levels as $level) {

            $save = $this->createQueryBuilder('u')
                ->innerJoin('u.exercices', 'e')
                ->select('MAX(e.number)')
                ->andWhere('e.level = :level')
                ->andWhere('u.users = :user')
                ->andWhere('u.finish = true')
                ->setParameter('level', $level)
                ->setParameter('user', $user)
                ->getQuery()
                ->getOneOrNullResult();

            $lastSaves[$level->getNumber()]=$save;
        }

        return $lastSaves;
    }

    public function getLastSave(User $user)
    {

        $save = $this->createQueryBuilder('u')
            ->innerJoin('u.exercices', 'e')
            ->innerJoin('e.level', 'l')
            ->select('(l.number)', '(e.number)')
            ->andWhere('u.finish = true')
            ->orderBy('u.value', 'DESC')
            ->andWhere('u.users = :user')
            ->setParameter('user', $user)
            ->orderBy('u.value', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();


        return $save;
    }

    public function getResults(User $user)
    {
        //on récupère l'équivalent de l'objet de connexion à pdo que l'on utilisait
        $connexion = $this->getEntityManager()->getConnection();
        //on stocke la requête dans une variable

        $sql = '
            SELECT u.time, e.number as exoNumber, l.number as levelNumber
            FROM exercice e INNER JOIN user_has_exercices u ON e.id = u.exercices_id 
            INNER JOIN level l ON e.level_id = l.id 
            WHERE u.users_id = :id 
          ';
        $select = $connexion->prepare($sql);
        $select->bindValue(':id', $user->getId());
        $select->execute();

        //je renvoie un tableau de tableaux de timer
        return $select->fetchAll();

    }

    public function getTopTimerByLevel($levelNumber)
    {

        //on récupère l'équivalent de l'objet de connexion à pdo que l'on utilisait
        $connexion = $this->getEntityManager()->getConnection();
        //on stocke la requête dans une variable

        $sql = '
            SELECT exercices_id, time, users_id, username, exercice.number as number, avatar
            FROM `user_has_exercices`
            INNER JOIN user ON user.id = `user_has_exercices`.`users_id`
            INNER JOIN exercice ON `user_has_exercices`.exercices_id = `exercice`.id
            INNER JOIN level ON level.id = exercice.level_id
            WHERE level.number = :levelNumber
            AND finish = 1
            AND time IN ( SELECT MIN(time) FROM `user_has_exercices` GROUP BY exercices_id )
            ORDER BY number
          ';
        $select = $connexion->prepare($sql);
        $select->bindValue(':levelNumber', $levelNumber);
        $select->execute();

        //je renvoie un tableau de tableaux de timer
        return $select->fetchAll();
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
