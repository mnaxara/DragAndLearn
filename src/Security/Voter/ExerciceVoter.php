<?php

namespace App\Security\Voter;

use App\Entity\Exercice;
use App\Entity\User;
use App\Entity\UserHasExercices;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ExerciceVoter extends Voter
{
    const VIEW ='view';

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, array(self::VIEW))
            && $subject instanceof \App\Entity\Exercice;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        //TODO auto accept pour niveau 1-1

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'view':
                if(($this->canView($user, $subject))){
                    return true;
                }
                else{
                    return false;
                }
                // logic to determine if the user can EDIT
                // return true or false
                break;
        }

        return false;
    }

    private function canView(User $user, Exercice $exercice){

        // Niveau en cours
        $level = $exercice->getLevel();
        // Valeur de l'exercice en cours
        $number = $exercice->getNumber();

        // Derniere sauvegarde du niveau en cours
        $save = $this->em
            ->getRepository(UserHasExercices::class)
                ->getLastSaves($user, [$level]);

        // Valeur du niveau en cours
        $level = $level->getNumber();

        //Valeur de l'exercice de la derniere sauvegarde du niveau en cours
        $searchNumber = $save[$level][1];


        // Si la valeur du dernier exercice sauvegardé est superieur ou egale à la valeur de l'exercice demandé - 1
        // On autorise.
        if ($searchNumber >= ($number - 1)){
            return true;
        }

        return false;


    }
}
