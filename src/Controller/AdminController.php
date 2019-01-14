<?php

namespace App\Controller;

use App\Entity\UserHasExercices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $user = $this->getUser();

        $repositoryU = $this->getDoctrine()->getRepository(UserHasExercices::class);
        $lastSave = $repositoryU->getLastSave($user);

        return $this->render('admin/index.html.twig', ['last_exercice' => $lastSave]);
    }
}
