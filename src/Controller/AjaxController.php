<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController
{
    /**
     * @Route("/ajax", name="ajax")
     */
    public function index()
    {
        return $this->render('ajax/index.html.twig', [
            'controller_name' => 'AjaxController',
        ]);
    }

    /**
     * @Route("/ajax/user", name="user", requirements={"id"="\d+"})
     */
    public function selectAllUsers()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $results = [];

        foreach($users as $user){

            $results[] = [
                'username' => $user->getUsername(),
                'email'    => $user->getEmail(),
                'avatar'   => $user->getAvatar(),
                'theme'    => $user->getTheme(),
                'role'     => $user->getRoles()
            ];

        }

        return $this->json(array('status' => 'ok', '$users' => $results));

    }

}
