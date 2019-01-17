<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\Level;
use App\Entity\User;
use App\Entity\UserHasExercices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomeController extends AbstractController
{
    /**
     * @Route ("/", name="home")
     */
    public function home (){

        return $this->redirectToRoute('app_login');

    }

    /**
     * @Route("/accueil", name="levelChoice")
     * 
     */
    public function levelChoice()
    {
        $user = $this->getUser();

        $repositoryU = $this->getDoctrine()->getRepository(UserHasExercices::class);
        $lastSave = $repositoryU->getLastSave($user);

        return $this->render('home/levelChoice.html.twig', ['last_exercice' => $lastSave]);
    }

}
