<?php

namespace App\Controller;

use App\Entity\Trophy;
use App\Entity\User;
use App\Form\ExerciceType;
use App\Form\UserType;
use App\Entity\Exercice;
use App\Entity\UserHasExercices;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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


//                          USER
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
        //on remplace le nom du fichier par un objet de classe File
        //pour pouvoir générer le formulaire

        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();

            //je ne fais le traitement que si une image a été envoyée
//            if($user->getAvatar()){
//                //je récupère le fichier
//                $file = $user->getAvatar();
//
//                $filename = $fileuploader->upload($file, $this->getParameter('user_image_directory'), $filename);
//            }

            $entityManager->persist($user);

            $entityManager->flush();

            return new Response('<div class="alert alert-success">Profil modifié</div>');

        }

        return $this->render("ajax/update_user.html.twig", ['userUpdateForm'=>$form->createView(), 'user'=>$user]);
    }



    /*
    /                         TIMER
    */
    
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


//                          EXERCICE
    /**
     * @Route("/ajax/exercice", name="ajaxExercice")
     */
    public function selectAllExercices()
    {

        return $this->render('ajax/exercice.html.twig');

    }

    /**
     * @Route("/ajax/exercice/search", name="ajaxExerciceSearch")
     */
    public function searchExercice(Request $request)
    {

        $search = $request->request->get('search');
        $exercices = $this->getDoctrine()->getRepository(Exercice::class)->lookForExercice($search);
        return $this->render('ajax/exercice_search.html.twig', ['exercices'=>$exercices]);


    }

    /**
     * @Route("/ajax/exercice/update/{id}", name="ajaxUpdateExercice", requirements={"id"="\d+"})
     */
    public function updateAjaxExercice(Request $request, Exercice $exercice)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(ExerciceType::class, $exercice);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $exercice = $form->getData();

            $entityManager->persist($exercice);

            $entityManager->flush();

            return new Response('<div class="alert alert-success">Exercice modifié</div>');

        }

        return $this->render("ajax/update_exercice.html.twig", ['exerciceUpdateForm'=>$form->createView(), 'exercice'=>$exercice]);
    }


//                          CLASSEMENT
    /**
     * @Route("/ajax/classement", name="ajaxClassement")
     */
    public function selectClassement()
    {

        return $this->render('ajax/classement.html.twig');

    }

    /**
     * @Route("/ajax/profile/username", name="ajaxProfileUsername")
     */
    public function setUsernameByProfile(Request $request)
    {
        $username = $request->request->get('username');
        $userId = $request->request->get('user');

        $user = $this->getDoctrine()->getRepository(User::class)->findOneById($userId);

        $user->setUsername($username);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return new Response ($username);

    }

    /**
     * @Route("/ajax/profile/avatar", name="ajaxProfileAvatar")
     */
    public function setAvatarByProfile(Request $request,  FileUploader $fileuploader)
    {
        $fileName = $this->getUser()->getAvatar();

        $files = $request->files->all();

        if (!empty($files)){

            $file = $files[0];

            $fileName = $file ? $fileuploader->upload($file, $this->getParameter('user_image_directory'),$fileName) : '';

            $this->getUser()->setAvatar($fileName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

        }


        return new Response ($fileName);

    }

}
