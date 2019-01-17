<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            $user->setAvatar(new File($this->getParameter('upload_directory') . $this->getParameter('article_image_directory') . '/' . $filename ));
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Profil modifié');

        }

        return $this->render("ajax/update_user.html.twig", ['userUpdateForm'=>$form->createView()]);
    }


}
