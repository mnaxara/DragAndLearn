<?php

namespace App\Controller;

use App\Entity\Exercice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/exercice/levelChoice", name="levelChoice")
     */
    public function levelChoice()
    {
        return $this->render('exercice/levelChoice.html.twig');
    }
}
