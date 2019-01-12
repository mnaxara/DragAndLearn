<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\Level;
use App\Entity\User;
use App\Entity\UserHasExercices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route ("/", name="home")
     */
    public function home (){

        $user = $this->getUser();

        $repository = $this->getDoctrine()->getRepository(Exercice::class);
        $exercice = $repository->find(121);

        $repositoryL = $this->getDoctrine()->getRepository(Level::class);
        $levels = $repositoryL->findAll();


        $repositoryU = $this->getDoctrine()->getRepository(UserHasExercices::class);
        $lastSave = $repositoryU->getLastSave($user, $levels);

        $save = $repositoryU->getSave($user, $exercice);

        dump($lastSave, $save);

        return $this->render('index.html.twig', ['save' => $save, 'last_save' => $lastSave]);

    }

    /**
     * @Route("/accueil", name="levelChoice")
     */
    public function levelChoice()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('home/levelChoice.html.twig');
    }

}
