<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\Level;
use App\Entity\Trophy;
use App\Entity\User;
use App\Entity\UserHasExercices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ExerciceController extends AbstractController
{
    /**
     * @Route("/exercice/tutoriel", name="tutoriel")
     */
    public function tutoriel()
    {
//        $exercice = $this->getDoctrine()->getRepository(Exercice::class)->findByNumber(1, 1);
        return $this->render('exercice/tuto.html.twig');
    }



    /**
     * @Route("/exercice/{slug}", name="exercice", requirements={"slug" = "[a-z0-9-]+"})
     */
    public function generateExercice(Request $request, Exercice $exercice)
    {
        $entityManager = $this->getDoctrine()->getManager();


        // On récupere le token de securité venant de la requete, id de l'exercice fini
        $submittedToken     = $request->request->get('token');
        $finishId           = $request->request->get('exFinish');
        // On récupere l'utilisateur
        $user = $this->getUser();


        // Si le token est bon

        if ($this->isCsrfTokenValid('next-token', $submittedToken)) {

            $saveRepository = $this->getDoctrine()->getRepository(UserHasExercices::class);
            $exerciceRepository = $this->getDoctrine()->getRepository(Exercice::class);


            // On recupere l'exercice terminé
            $finishExercice = $this->getDoctrine()->getRepository(Exercice::class)->find($finishId);

            // On verifie si une sauvegarde existe, si non, on sauvegarde
            if(($saveRepository->getFinishSave($user, $finishExercice)) === null){

                $save = $saveRepository->getSave($user, $finishExercice);
                $save->setFinish(true);

                //Number = valeur de l'exercice en cours, Level = valeur du niveau en cours
                $number = $finishExercice->getNumber();
                $levelNumber = $finishExercice->getLevel()->getNumber();

                // On crée les valeurs pour l'exercice suivant et on ajoute les trophées des exercices finaux
                if($number == 9 && $levelNumber == 1){
                    $nextExercice = $exerciceRepository->findByNumber(0, 2);
                    $nextValue = '20';
                    $trophy = $this->getDoctrine()->getRepository(Trophy::class)->findOneByLibelle('Niveau 1');
                    $user->addTrophy($trophy);
                    $entityManager->persist($user);
                }
                elseif ($number == 9 && $levelNumber == 2){
                    $nextExercice = $exerciceRepository->findByNumber(0, 3);
                    $nextValue = '30';
                    $trophy = $this->getDoctrine()->getRepository(Trophy::class)->findOneByLibelle('Niveau 2');
                    $user->addTrophy($trophy);
                    $entityManager->persist($user);
                }
                else{
                    $nextExerciceValue = $number + 1;
                    $nextExercice = $exerciceRepository->findByNumber($nextExerciceValue,$levelNumber);
                    $nextValue = $levelNumber.$nextExerciceValue;
                }

                // On crée la sauvegarde
                $newSave = new UserHasExercices();
                $newSave->setExercices($nextExercice);
                $newSave->setUsers($user);
                $newSave->setFinish(false);
                $newSave->setTime(new \DateTime('00:00:00'));
                $newSave->setValue($nextValue);
                $entityManager->persist($newSave);
                $entityManager->flush();

            }

        }

        // GESTION DU TIMER ************************************

        $timer = $this->getDoctrine()->getRepository(UserHasExercices::class)->getSave($user, $exercice);
        if($timer !== null){
            $timer = $timer->getTime();
            $timer = $timer->format('H:i:s');
            $explode = explode(':', $timer);
            $heureToSec = $explode[0] * 3600;
            $minToSec = $explode[1] * 60;
            $sec = $explode[2];

            $millsecTotale = ($heureToSec+$minToSec+$sec)*1000;
            $timer = intval($millsecTotale);

        }

        //*********************************************************

        // ON VERIFIE LES TROPHEE CACHE

        $trophies = $user->getTrophies();

        $trophyLibelle = [];
        foreach ($trophies as $trophy) {
            $trophyLibelle[] = $trophy->getLibelle();
        }

        $f12 = false;

        if (in_array('F12', $trophyLibelle)){
            $f12 = true;
        }

        $page = $exercice->getSlug();

        $this->denyAccessUnlessGranted('view', $exercice, 'Veuillez terminer les exercices précédents, petit tricheur !');

        return $this->render('exercice/'.$page.'.html.twig',
            ['exercice' => $exercice,
            'timer'=>$timer,
            'f12'=>$f12
            ]);
    }


}
