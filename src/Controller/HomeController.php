<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route ("/", name="home")
     */
    public function home (){

        return $this->render('index.html.twig');

    }

    /**
     * @Route("/accueil", name="levelChoice")
     */
    public function levelChoice()
    {
//        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('home/levelChoice.html.twig');
    }

}
