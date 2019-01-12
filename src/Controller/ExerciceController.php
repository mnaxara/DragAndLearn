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
     * @Route("/exercice/{slug}", name="tutoriel", requirements={"slug" = "[a-z0-9-]"})
     */
    public function generateExercice(Request $request, Exercice $exercice)
    {
        $user = $this->getUser();
        $save = $this->getDoctrine()->getRepository(UserHasExercices::class);


        return $this->render('exercice/tuto.html.twig');
    }


}
