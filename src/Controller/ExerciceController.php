<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\UserHasExercices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ExerciceController extends AbstractController
{
//    /**
//     * @Route("/exercice", name="exercice")
//     */
//    public function index()
//    {
//        return $this->render('exercice/index.html.twig', [
//            'controller_name' => 'ExerciceController',
//        ]);
//    }

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
        // On récupere le token de securité venant de la requete, id de l'exercice fini
        $submittedToken     = $request->request->get('token');
        $finishId           = $request->request->get('exFinish');

        $user = $this->getUser();

        $timer = $this->getDoctrine()->getRepository(UserHasExercices::class)->getSave($user, $exercice);
        $timer = $timer->getTime();
        $timer = $timer->format('H:i:s');
        // Si le token est bon

        if ($this->isCsrfTokenValid('next-token', $submittedToken)) {

            // On recupere l'exercice terminé
            $finishExercice = $this->getDoctrine()->getRepository(Exercice::class)->find($finishId);

            $saveRepository = $this->getDoctrine()->getRepository(UserHasExercices::class);
            // On verifie si une sauvegarde existe
            if(($saveRepository->getSave($user, $finishExercice)) === null){
                // Si non, on sauvegarde
                $save = new UserHasExercices();
                $save->setUsers($user);
                $save->setExercices($finishExercice);
                $save->setFinish(true);
                $number = $finishExercice->getNumber();
                $level = $finishExercice->getLevel()->getNumber();
                $value = $level.$number;
                $save->setValue($value);
                // On save dans la base
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($save);
                $entityManager->flush();

            }

        }

        $page = $exercice->getSlug();

        $this->denyAccessUnlessGranted('view', $exercice, 'Veuillez terminer les exercices précédents, petit tricheur !');

        return $this->render('exercice/'.$page.'.html.twig', ['exercice' => $exercice, 'timer'=>$timer]);
    }


}
