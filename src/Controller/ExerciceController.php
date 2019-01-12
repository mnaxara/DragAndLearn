<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\UserHasExercices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ExerciceController extends AbstractController
{
    /**
     * @Route("/exercice", name="exercice")
     */
    public function index()
    {
        return $this->render('exercice/index.html.twig', [
            'controller_name' => 'ExerciceController',
        ]);
    }

    /**
     * @Route("/exercice/tutoriel", name="tutoriel")
     */
    public function tutoriel()
    {
        return $this->render('exercice/tuto.html.twig');
    }

    /**
     * @Route("/exercice/{slug}", name="exercice", requirements={"slug" = "[a-z0-9-]+"})
     */
    public function generateExercice(Request $request, Exercice $exercice)
    {
        $this->denyAccessUnlessGranted('view', $exercice, 'Veuillez terminer les exercices précédents, petit tricheur !');
//        $user = $this->getUser();
//        dump($exercice, $user);
//        $save = $this
//            ->getDoctrine()
//                ->getRepository(UserHasExercices::class)
//                    ->getSave($user, $exercice);
//        dump($save);

        return $this->render('exercice/tuto.html.twig');
    }


}
