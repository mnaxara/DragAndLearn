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
     * @Route("/ajax/user", name="ajaxUser", requirements={"id"="\d+"})
     */
    public function selectAllUsers()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->lookForUser();

//        $results = [];

//        foreach($users as $user){
//
//            $results[] = [
//                'username' => $user->getUsername(),
//                'email'    => $user->getEmail(),
//                'avatar'   => $user->getAvatar(),
//                'theme'    => $user->getTheme(),
//                'role'     => $user->getRoles()
//            ];
//
//        }

        return $this->render('ajax/user.html.twig', [ 'users' => $users ]);

    }

}
