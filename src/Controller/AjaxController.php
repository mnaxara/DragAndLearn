<?php

namespace App\Controller;

use App\Entity\Trophy;
use App\Entity\User;
use App\Form\UserType;
use App\Entity\Exercice;
use App\Entity\UserHasExercices;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("/ajax/user", name="ajaxUser")
     */
    public function selectAllUsers()
    {

        return $this->render('ajax/user.html.twig');

    }

    /**
     * @Route("/ajax/user/search", name="ajaxUserSearch")
     */
    public function searchUsers(Request $request)
    {

        $search = $request->request->get('search');
        $users = $this->getDoctrine()->getRepository(User::class)->lookForUser($search);
        return $this->render('ajax/user_search.html.twig', ['users'=>$users]);

    }

    /**
     * @Route("/ajax/user/update/{id}", name="ajaxUpdateUser", requirements={"id"="\d+"})
     */
    public function updateAjaxUser(Request $request, User $user, FileUploader $fileuploader)
    {

        //je stocke le nom du fichier image
        $filename = $user->getAvatar();

        //on remplace le nom du fichier par un objet de classe File
        //pour pouvoir générer le formulaire
        if($user->getAvatar()){

            $user->setAvatar(new File($this->getParameter('upload_directory') . $this->getParameter('user_image_directory') . '/' . $filename ));
        }
        //dd($user);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();

            //je ne fais le traitement que si une image a été envoyée
            if($user->getImage()){
                //je récupère le fichier
                $file = $user->getImage();

                $filename = $fileuploader->upload($file, $this->getParameter('user_image_directory'), $filename);
            }

            $user->setAvatar($filename);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Profil modifié');

        }

        return $this->render("ajax/update_user.html.twig", ['userUpdateForm'=>$form->createView(), 'user'=>$user]);
    }


    /**
     * @Route("/ajax/timer", name="ajaxTimer")
     */
    public function setTimer(Request $request)
    {
        $timer = $request->request->get('timer');
        $userId = $request->request->get('user');
        $exercice = $request->request->get('ex');

        $finishExercice = $this->getDoctrine()->getRepository(Exercice::class)->findOneById($exercice);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneById($userId);

        $save = $this->getDoctrine()->getRepository(UserHasExercices::class)->getSave($user, $finishExercice);

        $timerdate = new \DateTime($timer);

        $save->setTime($timerdate);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return new Response ('kiki');

    }

    /**
     * @Route("/ajax/trophy", name="ajaxTrophy")
     */
    public function setTrophy(Request $request)
    {
        $trophy = $request->request->get('trophy');
        $userId = $request->request->get('user');

        $trophy = $this->getDoctrine()->getRepository(Trophy::class)->findOneByLibelle($trophy);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneById($userId);

        $user->addTrophy($trophy);


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return new Response ('kiki trophy');

    }

}
